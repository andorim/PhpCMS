<?php
$massage = "";
if(isset($_POST["login"])){
    $name = $_POST["username"];
    $passwd = $_POST["passwd"];
    $name = mysqli_real_escape_string($dbconnection,$name);
    $passwd = mysqli_real_escape_string($dbconnection,$passwd);
    $select = "SELECT id, name, passwd, authorization FROM user WHERE name='$name'";
    
    $result = mysqli_query($dbconnection,$select);
    if(($row = mysqli_fetch_assoc($result)) !== NULL){
        if(password_verify($passwd,$row["passwd"])){
            $_SESSION["userId"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["authorization"] = $row["authorization"];
            $_SESSION["lastIp"] = $_SERVER["REMOTE_ADDR"];

            header("Location: index.php");
        }
        else{
            $massage = "Benutzername oder Passwort falsch!";
            showLoginForm();
        }
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
    <h2>Login</h2>
    <form action="" method="POST">
    <label>Benutzername:</label>
    <input type="text" name="username" />
    <label>Passwort:</label>
    <input type="password" name="passwd" />
    <br />
    <input type="submit" name="login" value="Einloggen" />
    </form>
    <p><?php echo $massage ?></p>
    <p><a href="index.php?cat=LOGIN&site=register.php">Registrieren</a></p>
    <?php
}
?>

