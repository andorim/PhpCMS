<?php 
// Liste von allen Seiten. Von hier aus sollen diese Bearbeitet oder gar gelöscht werden können.
// Überlegung ob man einen Papierkorb(flag als gelöscht) macht, statt permanent zu löschen. 

$selectPages = "SELECT sites.id, categories.name as catName, sites.title, sites.type, sites.ordernumber 
FROM sites LEFT JOIN categories ON sites.categorie = categories.id ORDER BY categorie ASC, ordernumber ASC";

$result = mysqli_query($dbconnection,$selectPages);

echo "<p>".mysqli_error($dbconnection)."</p>";

?>
<table id="pagesTable">
    <thead>
        <tr>
            <?php
            $fields = mysqli_fetch_fields($result);
            $fieldName = "";
            foreach($fields as $field){
                switch($field->name){
                    case "id": $fieldName = "Seiten ID"; break;
                    case "catName": $fieldName = "Kategorie"; break;
                    case "title": $fieldName = "Seiten Titel"; break;
                    case "type": $fieldName = "Typ"; break;
                    case "ordernumber": $fieldName = "Reihenfolge"; break;
                }
                echo "<th>$fieldName</th>"; 
            }
            echo "<th>Aktionen</th>";

            

            ?>

        </tr>
    </thead>
    <tbody>
        <?php
        foreach($result as $row){?>
            <form action='' method='POST'>
            <tr>
                <td><input name="id" type=text value="<?php echo $row["id"] ?>" readonly /></td>
                <td><input name="catName" type=text value= "<?php echo $row["catName"]?>" readonly /></td>
                <!-- to be continued -->
                
            </tr>
            <?php
        }
        

        ?>

    </tbody>
</table>
<p>to be continued</p>

<?php


?>