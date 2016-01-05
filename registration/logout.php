<?php

session_start();
session_destroy();
session_start();
$_SESSION['reglog'] = "logout";
echo "<meta http-equiv=\"refresh\" content=\"0; URL=/helping_supplies/index.php\">";
exit;
?>


