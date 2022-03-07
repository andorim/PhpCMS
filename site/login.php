<?php
$massage = "";
if(isset($_POST["login"])){
    $name = $_POST["username"];
    $passwd = $_POST["passwd"];

    $dbconnection = mysqli_connect(DATABASE_SERVER,DATABASE_USER,DATABASE_PASWD,DATABASE_NAME);

    $select = "SELECT id, name, authorization FROM user WHERE name='$name' AND passwd='$passwd'";

    $result = mysqli_query($dbconnection,$select);
    if(($row = mysqli_fetch_assoc($result)) !== NULL){
        $_SESSION["userId"] = $row["id"];
        $_SESSION["username"] = $row["name"];
        $_SESSION["authorization"] = $row["authorization"];
        $_SESSION["lastIp"] = $_SERVER["REMOTE_ADDR"];

        header("Location: index.php");
        ?>
        <?php
    }
    else{
        $massage = "Benutzername oder Passwort falsch!";
        showLoginForm();
    }

}
else{
    showLoginForm();
}
?>

<?php
function showLoginForm(){ 
    global $massage;
    ?>
    <form action="" method="POST">
    <label>Benutzername:</label>
    <input type="text" name="username" />
    <label>Passwort:</label>
    <input type="password" name="passwd" />
    <br />
    <input type="submit" name="login" value="Einloggen" />
    </form>
    <p><?php echo $massage ?></p>
    <?php
}
?>

