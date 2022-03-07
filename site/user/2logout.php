<?php
header("Location: index.php");
setcookie("CMS", session_id(),1,$_SERVER["PHP_SELF"]);
session_unset();
echo "Sie wurden erfolgreich ausgeloggt";

?>
