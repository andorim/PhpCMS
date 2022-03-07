<?php
if(isset($_POST["catId"]) && isset($_POST["name"]) && isset($_POST["typ"]) && isset($_POST["inputContent"])){
    $catId = $_POST["catId"];
    $title = mysqli_escape_string($dbconnection,htmlspecialchars($_POST["name"]));
    $type = $_POST["typ"];
    $content = mysqli_escape_string($dbconnection,htmlspecialchars($_POST["inputContent"])); 
    $selectLastOrderNumber = "SELECT ordernumber FROM sites  WHERE categorie=$catId ORDER BY ordernumber DESC LIMIT 1";
    $result = mysqli_query($dbconnection,$selectLastOrderNumber);
    echo mysqli_error($dbconnection);
    $lastOrderNumber = 0;
    if(($row = mysqli_fetch_assoc($result)) !== NULL){
        $lastOrderNumber = $row["ordernumber"];
    }
    $nextOrderNumber = $lastOrderNumber + 1;
    $insert = "INSERT INTO sites (categorie,title,content,type,ordernumber) 
                VALUES ($catId,'$title','$content','$type',$nextOrderNumber)";


    mysqli_query($dbconnection,$insert);

    echo mysqli_error($dbconnection);
    
    echo "<h2>Die seite $title wurde angelegt!</h2>";

    mysqli_free_result($result);

    ?>
<?php
}else{
    ?>
    <h2>Neue Seite Anlegen</h2>

    <form id="formNewPage" action="" method="post">
        <label>Kategorie:</label>
        <select name="catId" required="required">
            <?php

                $catSelect = "SELECT * FROM categories WHERE NOT id=1 ORDER BY ordernumber ASC";
                $catResult = mysqli_query($dbconnection,$catSelect);

                foreach($catResult as $cat){
                    echo "<option value='$cat[id]'>".$cat["name"]."</option>";
                }
                mysqli_free_result($catResult);
            ?>
        </select>
        <br />
        <label>Name:</label>
        <input name="name" type="text"  required="required"/>
        <label>Typ: (wenn der Typ "php" ist, dann muss als Inhalt nur der Pfad zu PHP-Datei angegeben werden!)</label>
        <select name="typ" required="required">
            <option value="txt">txt</option>
            <option value="html">html</option>
            <option value="php">php</option>
        </select>
        <br />
        <label>Inhalt: </label>
        <textarea name="inputContent" type="textarea" id="inputContent" required="required"></textarea>
        <br />
        <br />
        <input type="submit" value="Speichern">
    </form>
    <?php
}
?>
