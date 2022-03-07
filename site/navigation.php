<?php     
    //Navigation Home
    echo "<div class='nav-item'>";
    echo "<div class='nav-item-disc'>";
    echo "<a href='".$_SERVER['SCRIPT_NAME']."?cat=1&site=1'>";
    echo "HOME";
    echo "</a></div></div>";
    
    //Navigation Categories
    $select = "";
    if(isset($_SESSION["authorization"])){
        if($_SESSION["authorization"] == "ADMIN"){
            $select = "SELECT id,name FROM categories WHERE NOT id=1 ORDER BY ordernumber ASC";
        }elseif($_SESSION["authorization"] == "USER"){
            $select = "SELECT id,name FROM categories WHERE NOT id=1 AND authlevel='PUBLIC' OR authlevel='USER' ORDER BY ordernumber ASC";
        }
    }
    else{
        $select = "SELECT id,name FROM categories WHERE NOT id=1 AND authlevel='PUBLIC' ORDER BY ordernumber ASC";
    }
    
    

    $catResult = mysqli_query($dbconnection,$select);

    echo mysqli_error($dbconnection);

    foreach($catResult as $cat){
        echo "<div class='nav-item'>";
        echo "<div class='nav-item-disc'>";
        echo strtoupper($cat["name"]);
        echo "</div>";
        echo "<div class='nav-item-drop-down'>";
        
        $select = "SELECT id,title FROM sites WHERE categorie = '$cat[id]' ORDER BY ordernumber ASC";
        $siteResult = mysqli_query($dbconnection, $select);
        echo mysqli_error($dbconnection);
        foreach($siteResult as $site){               
                echo "<div class='nav-item-drop-down-item'>";
                echo "<a href='".$_SERVER['SCRIPT_NAME']."?cat=$cat[id]&site=$site[id]'>";
                echo strtoupper($site["title"]);
                echo "</a></div>";
        }
        mysqli_free_result($siteResult);
        echo "</div>";
        echo "</div>";
    }

    mysqli_free_result($catResult);

    if(!isset($_SESSION["username"])){
        //Navigation Login
        echo "<div class='nav-item admin'>";
        echo "<div class='nav-item-disc'>";
        echo "<a href='index.php?cat=LOGIN&site=login.php'>Login</a>";
        echo "</div>";
        echo "</div>";
    }
    if(isset($_SESSION["username"])){
        //Navigation User
        echo "<div class='nav-item admin'>";
        echo "<div class='nav-item-disc'>";
        echo $_SESSION["username"];
        echo "</div>";
        echo "<div class='nav-item-drop-down'>";
        echo "<div class='nav-item-drop-down-item'>";
        echo "<a href='index.php?cat=USER&site=1setTheme.php'>SetTheme</a>";
        echo "</div>";
        echo "<div class='nav-item-drop-down-item'>";
        echo "<a href='index.php?cat=USER&site=2logout.php'>Logout</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        
    }
    
    if(isset($_SESSION["authorization"]) && $_SESSION["authorization"] == "ADMIN"){
        //Navigation Admin
        echo "<div class='nav-item admin'>";
        echo "<div class='nav-item-disc'>";
        echo "ADMIN";
        echo "</div>";
        echo "<div class='nav-item-drop-down'>";
        $folder ="admin";
        $contents = scandir("./".$folder);
        foreach($contents as $content){
            if($content !== "." && $content !== ".."){
                $pointIndex = strrpos($content,".");
                $fileExt = substr($content,$pointIndex);
                $contentText = substr($content,1,strlen($content)-strlen($fileExt)-1);
                
                echo "<div class='nav-item-drop-down-item'>";
                echo "<a href='".$_SERVER['SCRIPT_NAME']."?cat=ADMIN&site=$content'>";
                echo strtoupper($contentText);
                echo "</a></div>";
            }
        }
        echo "</div>";
        echo "</div>";
    }    
?>