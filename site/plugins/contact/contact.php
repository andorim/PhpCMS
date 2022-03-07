<?php 
    if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["request"])){
        $dbconnection = mysqli_connect(DATABASE_SERVER,DATABASE_USER,DATABASE_PASWD,DATABASE_NAME);
        $senderName = mysqli_escape_string($dbconnection,htmlspecialchars($_POST["name"]));
        $senderMail = mysqli_escape_string($dbconnection,htmlspecialchars($_POST["email"]));
        $content = mysqli_escape_string($dbconnection,htmlspecialchars($_POST["request"]));

        // Überprüfen ob E-Mail Valide sein könnte
        

        if(filter_var($senderMail,FILTER_VALIDATE_EMAIL) !== false ){
            $insert = "INSERT INTO contacts (sender_name,sender_mail,content) 
                            VALUES ('$senderName','$senderMail','$content')";

            if(mysqli_query($dbconnection,$insert)){
                echo "Danke ".$senderName." Ihre Anfrage wurde erfolgreich übermittelt.<br />";
            echo "Wir werden Sie unter der E-Mail Adresse ".$senderMail." kontaktieren.";
            }else{
                echo "Es ist ein Fehler aufgetreten!";
                echo mysqli_error($dbconnection);
            }
            mysqli_close($dbconnection);
        }else{
            echo "Sie haben eine falsche Email-Adresse angegeben, bitte versuchen Sie es erneut!";
        }
    }
    else{ ?>
        <style>
            .lbl{
                width: 150px;
                float: left;
                clear: both;
            }
            .input{
                float:left;
                margin-bottom: 20px;
            }
            .clear{
                clear: both;
            }
            textarea{
                height: 300px;
                width: 400px;
            }
        </style>
        <h2>Kontakt</h2>
        <form method="POST" action="">
            <label class="lbl">Ihr Name:</label>
            <input type="text" name="name" placeholder="z.B. Max Mustermann" class="input" required="required" />

            <label class="lbl">Ihre E-Mail Adresse:</label>
            <input type="email" name="email" placeholder="z.B. max@example.de" class="input" required="required" />

            <label class="lbl">Anfrage: </label>
            <textarea name="request" placeholder="z.B. Hallo, ich hätte gerne ... " class="input" required="required" ></textarea>
            <div class="clear"></div>
            <input type="submit" name="abschicken" value="Abschicken"  class="input" />
        </form>
        <?php
    }
    ?>
