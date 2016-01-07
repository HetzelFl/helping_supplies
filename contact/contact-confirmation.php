<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include userContrule
include($root . "/helping_supplies/includes/userControl.php");

$title = filterfunktion($_POST["title"]);
$reason = filterfunktion($_POST["reason"]);
$message = filterfunktion($_POST["message"]);
$Absender = filterfunktion($_POST["Absender"]);

//TODO E-Mail ändern
$eMail = "name@ihre-domain.de";

//TODO aktivieren
//mail($eMail, $reason . ": " . $title, $message, "FROM: $Absender");
//Mail an eigene eMail
if (isset($_POST["mailMe"])) {

    //TODO aktivieren
    //mail($Absender, $reason . ": " . $title, "KOPIE IHRER NACHRICHT<br>" . $message, "FROM: $eMail");
}
$_SESSION['reglog'] = "contactOk";
header('Location: /helping_supplies/index.php');

?>