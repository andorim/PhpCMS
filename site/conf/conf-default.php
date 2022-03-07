<?php
    //Datenbankkonfiguration
    define("DATABASE_SERVER", "host");
    define("DATABASE_USER", "user");
    define("DATABASE_PASWD", "passwd");
    define("DATABASE_NAME", "database");

    //CMS Konfiguration
    $dbconnection = mysqli_connect(DATABASE_SERVER,DATABASE_USER,DATABASE_PASWD,DATABASE_NAME);
    mysqli_set_charset($dbconnection,"utf8mb4");
    $select = "SELECT * FROM config";
    $result = mysqli_query($dbconnection,$select);
    foreach($result as $row){
        switch($row["option"]){
            case "WEBSITE_NAME":
                define("WEBSITE_NAME", $row["value"]);
                break;
            case "WEBSITE_TITLE":
                define("WEBSITE_TITLE", $row["value"]);
                break;
            case "PARTY":
                define("PARTY", filter_var($row["value"], FILTER_VALIDATE_BOOLEAN));
                break;
        }
    }
    
    //Inlcude zusätzlicher Config Dateien
?>