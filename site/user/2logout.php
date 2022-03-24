<?php
header("Location: index.php");
setcookie(session_name(), session_id(),1,session_get_cookie_params()["path"]);
session_unset();
echo "Sie wurden erfolgreich ausgeloggt";

?>
