<div id="wrapper">
<?php
    $site = $_GET["site"];
    $cat = $_GET["cat"];
    $authorized = false;

    $dbconnection = mysqli_connect(DATABASE_SERVER,DATABASE_USER,DATABASE_PASWD,DATABASE_NAME);
    $contentRow = "";
    $selectCatAuthLevel = "SELECT authlevel FROM categories WHERE id=$cat";
    $result = mysqli_query($dbconnection,$selectCatAuthLevel);
    echo mysqli_error($dbconnection);
    
    $catAuthLevel = "ADMIN";
    if(($contentRow = mysqli_fetch_assoc($result)) !== NULL){
        $catAuthLevel = $contentRow["authlevel"];
    }

    if(isset($_SESSION["authorization"])){
        if(isset($_SESSION["authorization"]) && $_SESSION["authorization"] == "ADMIN"){
            $authorized = true;
        }elseif($_SESSION["authorization"] == "USER" && ($catAuthLevel == "PUBLIC" || $catAuthLevel == "USER")){
            $authorized = true;
        }else{
            $authorized = false;
        }
    }else{
        if($catAuthLevel == "PUBLIC"){
            $authorized = true;
        }else{
            $authorized = false;
        }
    }
    
    if($authorized){
        $select = "SELECT title,content,type,created,updated FROM sites WHERE id=$site AND categorie=$cat";

        $result = mysqli_query($dbconnection,$select);
        mysqli_close($dbconnection);
        if(($contentRow = mysqli_fetch_assoc($result)) !== NULL){
            if($contentRow["type"] == "txt"){
                echo "<h2>$contentRow[title]</h2>";
                echo "<pre>".$contentRow["content"]."</pre>";
            }elseif($contentRow["type"] == "php"){
                include($contentRow["content"]);
            }
            else{
                echo htmlspecialchars_decode($contentRow["content"]);
            }
        }
        else{
            echo "404 Not Found";
            $authorized = false;
        }
        
        

        mysqli_free_result($result);
    }
    else{
        echo "Nicht berechtigt!";
        $authorized = false;
    }
    
    
    
    
    
?>
</div>
<?php
    if($authorized && $contentRow["type"] !== "php"){
        echo "<div class='content-info'>Created: $contentRow[created] Updated: $contentRow[updated]</div>";
    }  
?>