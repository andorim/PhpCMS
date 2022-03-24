<?php
    if(isset($_POST["register"])){
        $username = mysqli_real_escape_string($dbconnection,$_POST["username"]);
        $passwdClear = mysqli_real_escape_string($dbconnection,$_POST["passwd"]);

        $regExUser = "/^[a-zA-Z0-9]{4,50}$/";
        $regExPasswd = "/^(?!.*?[äüöß])(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{8,}$/";

        if((preg_match($regExUser,$username) != 0) && (preg_match($regExPasswd,$passwdClear) != 0)){
            $passwdHash = password_hash($passwdClear, PASSWORD_DEFAULT);
            
            $insert = "INSERT INTO user (name, passwd) VALUES ('$username', '$passwdHash')";
            mysqli_query($dbconnection,$insert);

            if(mysqli_errno($dbconnection) !== 0){
                if(mysqli_errno($dbconnection) == 1062){
                    echo "Der Nutzername ist leider schon vergeben!";
                }
                else{
                    echo mysqli_errno($dbconnection);
                    echo "<br />";
                    echo mysqli_error($dbconnection);
                    echo "<br />";
                
                }
                showRegisterForm();
            }else{
                echo "Du hast dich erfolgreich registriert. Du kannst dich nun einloggen";
            }
        }else{
            echo "Der Benutzername oder das Passwort ist ungültig!";
            showRegisterForm();
        } 
    }
    else{
        showRegisterForm();
    }


    function showRegisterForm(){ 
        global $massage;
        ?>
        <h2>Registrieren</h2>
        <form action="" method="POST">
            <label>Benutzername: (mindestens 4 Zeichen, keine Sonderzeichen)</label>
            <input type="text" name="username" />
            <label>Passwort: (mindestens 1 Großbuchstabe, 1 Kleinbuchstabe, eine Zahl und ein Sonderzeichen(#?!@$%^&*-.))</label>
            <input type="password" name="passwd" />
            <br />
            <input type="submit" name="register" value="Registrieren" />
        </form>
        <p><?php echo $massage ?></p>
        <?php
    }

?>