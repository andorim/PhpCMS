<?php require("./conf/conf.php");?>

<?php 
    session_start(["name" => "CMS", "cookie_path" => $_SERVER["PHP_SELF"]]);
    if(isset($_SESSION["username"])){
        if($_SERVER["REMOTE_ADDR"] !== $_SESSION["lastIp"]){
            setcookie("CMS", session_id(),1,$_SERVER["PHP_SELF"]);
            session_unset();
            header("Location: index.php");
        }
    }
    if(!isset($_GET["cat"])){
        $_GET["cat"] = 1;
        $_GET["site"] = 1;
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <title><?php echo WEBSITE_TITLE ?></title>
        <meta charset="UTF-8" />
        <link rel="icon" type="image/png" sizes="32x32" href="assets/icons/32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/icons/16.png">
        <?php
        require("theme.php");
        ?>
    </head>
    <body>
        <div id="header">
            <h1 id="headline"><?php echo WEBSITE_NAME ?></h1>
            <?php
            
            if(PARTY){?>
                <div id="alien">
                <img src="https://cdn.betterttv.net/emote/61ec2ada06fd6a9f5be1b646/3x" />
                </div>
                <div class="clear"></div>
            <?php } ?>
            
        </div>
        <nav>
            <?php
                include("navigation.php");
            ?>
        </nav>
        <main id="content">
            <?php
                if($_GET["cat"]==="LOGIN"){
                    $indexContent = $_GET["site"];
                    echo "<div id='wrapper'>";
                    include($indexContent);
                    echo "</div>";
                }
                elseif($_GET["cat"]==="ADMIN"){
                    if(isset($_SESSION["authorization"]) && $_SESSION["authorization"] == "ADMIN"){
                        $indexContent = "admin/".$_GET["site"];
                        echo "<div id='wrapper'>";
                        include($indexContent);
                        echo "</div>";
                    }
                    else{
                        echo "Keine Berechtigung!";
                    }
                }elseif($_GET["cat"]==="USER"){
                    if(isset($_SESSION["authorization"]) && ($_SESSION["authorization"] == "ADMIN" || $_SESSION["authorization"] == "USER")){
                        $indexContent = "user/".$_GET["site"];
                        echo "<div id='wrapper'>";
                        include($indexContent);
                        echo "</div>";
                    }
                    else{
                        echo "Keine Berechtigung!";
                    }    
                }else{
                    include("content.php");
                }  
            ?>
        </main>
        <footer>
            <?php
                include("footer.php");
            ?>
        </footer>
        <?php

        ?>
    </body>
    
</html>