<?php
    $dbconnction = mysqli_connect(DATABASE_SERVER,DATABASE_USER,DATABASE_PASWD,DATABASE_NAME);
    if(isset($_POST["site"])){
        //Wenn eine Datei zum editieren ausgewählt wurde
        $siteId = $_POST["site"];
        $selectSite = "SELECT title,content,type FROM sites WHERE id=$siteId";
        $result = mysqli_query($dbconnction,$selectSite);
        $row = mysqli_fetch_assoc($result);
        $siteTitle = $row["title"];
        $siteContent = $row["content"];
        $siteType = $row["type"];
        mysqli_free_result($result);
        mysqli_close($dbconnction);
        ?>
        <h2>Die Datei<?php echo " ".$_POST["site"] ?> wurde ausgewählt</h2>
        <form action="" name="editContent" method="POST">
            <input name="editSite" value="<?php echo $siteId; ?>" style="display:none;"/>
            <label>Titel: </label>
            <input name="editTitle" value="<?php echo $siteTitle; ?>" type="text" />
            <label>Typ: (wenn der Typ "php" ist, dann muss als Inhalt nur der Pfad zu PHP-Datei angegeben werden!)</label>
            <select name="editType" required="required">
                <option value="txt" <?php if($siteType == "txt") echo "selected";?>>txt</option>
                <option value="html" <?php if($siteType == "html") echo "selected";?>>html</option>
                <option value="php" <?php if($siteType == "php") echo "selected";?>>php</option>
            </select>
            <label>Inhalt: </label>
            <textarea id="editContent" name="editContent"><?php echo $siteContent;?></textarea>
            <br />
            <br />
            <input type="submit" value="Speichern" />

        </form>

        <?php
    }
    elseif(isset($_POST["editContent"])){
        $siteId = $_POST["editSite"];
        $siteTitle = mysqli_escape_string($dbconnction,htmlspecialchars($_POST["editTitle"]));
        $siteContent = mysqli_escape_string($dbconnction,htmlspecialchars($_POST["editContent"]));
        $siteType = $_POST["editType"];

        $update = "UPDATE sites SET title='$siteTitle', content='$siteContent', type='$siteType' WHERE id=$siteId";
        if(mysqli_query($dbconnction,$update)){
            echo "<h2>Die Seite $siteTitle wurde gespeichert</h2>";
        }else{
            echo "Es ist ein Fehler aufgetreten!";
            echo mysqli_error($dbconnction);
        }
        mysqli_close($dbconnction);
        
        
    }
    //Wenn noch keine Datei zum editieren ausgewählt wurde
    else{
        ?>
        <h2>Seite bearbeiten</h2>
        <form name="setFile" action="" method="POST">
            <select name="site">
                <?php
                    $selectCats = "SELECT id,name FROM categories ORDER BY ordernumber ASC";
                    $catResult = mysqli_query($dbconnction,$selectCats);
                    foreach($catResult as $cat){
                        $selectSites = "SELECT id,title FROM sites WHERE categorie=$cat[id] ORDER BY ordernumber ASC";
                        $sitesResult = mysqli_query($dbconnction,$selectSites);
                        foreach($sitesResult as $site){
                            echo "<option value='$site[id]'>$cat[name]/$site[title]</option>";
                        }
                    }
                    mysqli_free_result($catResult);
                    mysqli_free_result($sitesResult);
                    mysqli_close($dbconnction);
                ?>
            </select>
            <br />
            <br />
            <input type="submit" value="Auswählen" />
        </form>
    <?php
    }
?>

