<?php 
if(isset($_SESSION["authorization"]) == "ADMIN"){
?>
<style>
    table{
        border: 1px solid black;
        border-collapse: collapse;
    }
    th{
        border: 1px solid black;
        background-color: darkblue;
        color: white;
    }
    td{
        padding: 5px;
        border: 1px solid black;
        background-color: lightcyan;
    }
    .name{
        width: 150px;
    }
    .mail{
        width: 200px;
    }
    .request{
        width: 500px;
        overflow-wrap: normal;
    }
    .date{
        width: 100px;
    }

</style>

<h2>Anfragen</h2>
<table>
    <tr>
        <th class="name">Name</th>
        <th class="mail">E-Mail-Adresse</th>
        <th class="request">Anfrage</th>
        <th class="date">Datum</th>
    </tr>
    <?php
        $dbconnection = mysqli_connect(DATABASE_SERVER,DATABASE_USER,DATABASE_PASWD,DATABASE_NAME);

        $select = "SELECT sender_name, sender_mail, content, created FROM contacts";

        $result = mysqli_query($dbconnection,$select);

        foreach($result as $row){
            echo "<tr>";
            echo "<td>$row[sender_name]</td>";
            echo "<td><a href='mailto:$row[sender_mail]'>$row[sender_mail]</a></td>";
            echo "<td>$row[content]</td>";
            echo "<td>$row[created]</td>";
            echo "</tr>";
        }
        
    ?>
</table>
<?php
}
else{
    echo "Keine Berechtigung!";
}