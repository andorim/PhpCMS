<?php
$currentTheme = $theme;
$massage = "";
if(isset($_POST["theme"])){
    $massage = "Einstellung wurde gespeichert! Bitte seite neu laden!";
    setcookie("theme".$_SESSION["username"],$_POST["theme"],time()+60*60*24*365);
    header("Location: index.php");
    ?>
    
    <?php
}


$availableThemes = scandir("css/themes/");
?>
<form action="" method="POST">
    <select name="theme">
        <?php
        foreach($availableThemes as $folder){
            if($folder !== "." && $folder !== ".."){
                if($folder == $currentTheme){
                    echo "<option value='$folder' selected>$folder</option>";
                }else{
                    echo "<option value='$folder'>$folder</option>";
                }
            }
        }
        ?>
    </select>
    <input type="submit" value="Speichern" />
</form>
<p id="massage"><?php echo $massage ?></p>