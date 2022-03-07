<?php
    //default Theme
    $theme = "default";
    if(isset($_SESSION["username"]) && isset($_COOKIE["theme".$_SESSION["username"]])){
        $theme = $_COOKIE["theme".$_SESSION["username"]];
    }elseif(isset($_SESSION["username"]) && !isset($_COOKIE["theme".$_SESSION["username"]])){
        setcookie("theme".$_SESSION["username"],"default",time()+60*60*24*365);
    }

    echo "<link rel='stylesheet' href='css/themes/$theme/nav.css'>";
    echo "<link rel='stylesheet' href='css/themes/$theme/default.css'>";
    echo "<link rel='stylesheet' href='css/themes/$theme/admin.css'>";

    if(PARTY){ 
        echo "<link rel='stylesheet' href='css/themes/$theme/party.css'>";  
    }
    
?>

