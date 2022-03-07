<?php
    if(isset($_POST["catName"])){

        $selectLastOrderNumber = "SELECT ordernumber FROM categories ORDER BY ordernumber DESC LIMIT 1";
        $result = mysqli_query($dbconnection,$selectLastOrderNumber);
        $lastOrderNumber = 0;
        if(($row = mysqli_fetch_assoc($result)) !== NULL){
            $lastOrderNumber = $row["ordernumber"];
        }
        $nextOrdernumber = $lastOrderNumber + 1; 

        $name = $_POST["catName"];
        $authlevel = $_POST["authlevel"];
        $insert = "INSERT INTO categories (name,ordernumber,authlevel)
                        VALUES ('$name',$nextOrdernumber,'$authlevel')";

        if(mysqli_query($dbconnection,$insert)){
            echo "Die Kategorie $name wurde angelegt!";
        }else{
            echo "Es ist ein Fehler aufgetreten!";
            echo mysqli_error($dbconnection);
        }
        mysqli_free_result($result);
    }
?>
<form id="formNewPage" action="" method="post">
        <label>Kategoriename:</label>
        <input type="text" name="catName"/>
        <label>Zugriffslevel:</label>
        <select name="authlevel">
            <option value="PUBLIC">PUBLIC</option>
            <option value="USER">USER</option>
            <option value="ADMIN">ADMIN</option>
        </select>
        <br />
        <input type="submit" value="Speichern" />
</form>