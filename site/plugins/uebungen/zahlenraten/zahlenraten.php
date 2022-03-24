<h2>Zahlenraten</h2>
<?php
    

    $min = 0;
    $max = 20;
    $randomNumber = 0;
    $gameNo = 0;
    $tries = 1;
    $massage = "";
    $userId = 0;

    if(isset($_SESSION["userId"])){
        $userId = $_SESSION["userId"];
    }else{
        $userId = 0;
    }

    if(isset($_POST["min"])){
        $min = mysqli_real_escape_string($dbconnection,$_POST["min"]);
        $max = mysqli_real_escape_string($dbconnection,$_POST["max"]);
    }
    function setActiveGame(){
        global $min;
        global $max;
        global $gameNo;
        global $randomNumber;
        global $tries;
        global $massage;
        global $userId;
        global $dbconnection;

        $select = "SELECT id,min,max,randomnumber,tries FROM zahlenraten WHERE solved=0 AND userid=$userId ORDER BY id DESC LIMIT 1";
        
        $result = mysqli_query($dbconnection,$select);
        
        echo mysqli_error($dbconnection);


        if(($row = mysqli_fetch_assoc($result)) !== NULL){
            

            $min = $row["min"];
            $max = $row["max"];
            $gameNo = $row["id"];
            $randomNumber = $row["randomnumber"];
            $tries = $row["tries"];
            $massage = "Spiel geladen!";
        }
        else{
            setNewGame();
        }
    }
    function setNewGame(){
        global $dbconnection;
        global $min;
        global $max;
        global $gameNo;
        global $randomNumber;
        global $tries;
        global $massage;
        global $userId;

        $randomNumber = rand($min,$max);
        $tries = 1;


        $insert = "INSERT INTO zahlenraten (userid,min,max,randomnumber)
            	        VALUES ($userId,$min,$max,$randomNumber)";
        
        mysqli_query($dbconnection,$insert);

        $select = "SELECT id FROM zahlenraten ORDER BY id DESC LIMIT 1";
        
        $result = mysqli_query($dbconnection,$select);

        if(($row = mysqli_fetch_assoc($result)) !== NULL){
            $gameNo = $row["id"];
            $massage = "Neues Spiel erstellt!";
        }
    }
    function updateGame($solved){
        global $dbconnection;
        global $gameNo;
        global $tries;
        $update = "";

        if($solved){
            $update = "UPDATE zahlenraten SET tries=$tries, solved=1 WHERE id=$gameNo";

            mysqli_query($dbconnection,$update);
        }else{
            $tries++;
            $update = "UPDATE zahlenraten SET tries=$tries WHERE id=$gameNo";

            mysqli_query($dbconnection,$update);
        }
    }
    setActiveGame();
    if(isset($_POST["guess"])){
        $guess = $_POST["guess"];
        if($guess == $randomNumber){
            $massage = "Das war richtig! Herzlichen Glückwunsch!";
            updateGame(true);
            showSolved();
        }
        elseif($guess < $randomNumber){
            $massage = "Das war leider nicht richtig! Deine eingabe war zu niedrig!";
            updateGame(false);
            showGame();
        }
        elseif($guess > $randomNumber){
            $massage = "Das war leider nicht richtig! Deine eingabe war zu hoch!";
            updateGame(false);
            showGame();
        }
        else{
            $massage = "Da ist etwas schief gelaufen!";
            showGame();
        }
    }
    else{
        showGame();
    }
    
?>
<style>
    #task{
        margin-bottom: 10px;
    }
    #hint{
        margin-top: 10px;
    }
    .tableFixedHead{
        max-height: 500px;
        overflow-y: auto;
        width: fit-content;
    }
    .tableFixedHead thead th{
        position: sticky;
        top: 0;
    }
    table{
        border-collapse: collapse;
        
    }
    th{
        border: 1px solid black;
        padding: 10px;
        background-color: darkblue;
        color: white;
    }
    td{
        border: 1px solid black;
        padding: 5px;
    }
</style>
<?php 
    function showGame(){  
        global $min;
        global $max;
        global $gameNo;
        global $tries;
        global $massage;
        ?>
        <h3>Spiel Nr: <?php echo $gameNo ?></h3>
        <h5>Versuch Nr: <?php echo $tries ?></h5>
        <div id="task">
            Errate eine Zahl zwischen <?php echo $min ?>  und <?php echo $max ?> 
        </div>
        <form action="" method="POST">
            <input name="guess" type="number" autofocus/>
            <input type="submit" value="Eingeben" />
        </form>
        <div id="hint">
            <?php echo $massage ?>
        </div>
<?php   
    } 
?>
<?php
    function showSolved(){
        global $massage;
        ?>
        <p><?php echo $massage ?></p>
        <form action="" method="POST">
            <label>Min: </label>
            <input name="min" value = 0 type="number" />
            <label>Max: </label>
            <input name="max" value = 20 type="number" />
            <br /><br />
            <input type="submit" value="Neues Spiel" />
        </form>
        <?php
    }
?>
<br />
<hr />
<h3>Deine bisherigen Spiele</h3>
<div class="tableFixedHead">
    <table>
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Min</th>
                <th>Max</th>
                <th>generierte Zahl</th>
                <th>Anzahl Versuche</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $select = "SELECT id,min,max,randomnumber,tries FROM zahlenraten WHERE solved=1 AND userid=$userId ORDER BY id DESC";

            $result = mysqli_query($dbconnection,$select);
            foreach($result as $row){
                echo "<tr>";
                echo "<td>$row[id]</td>";
                echo "<td>$row[min]</td>";
                echo "<td>$row[max]</td>";
                echo "<td>$row[randomnumber]</td>";
                echo "<td>$row[tries]</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>