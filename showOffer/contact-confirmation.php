<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include userContrule
include($root . "/helping_supplies/includes/userControl.php");

//Kontrolle ob Formular erlaubt aufgerufen wurde
if (!isset($_POST['link'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
if (!isset($_SESSION['accountsId'])) {
    header('Location: ' . $_POST['link']);
    $_SESSION['reglog'] = "contactFail";
    exit;
}
$title = filterfunktion($_POST["title"]);
$reason = filterfunktion($_POST["reason"]);
$message = filterfunktion($_POST["message"]);
$eMail = filterfunktion($_POST["eMail"]);

//eMail des Users aus DB holen
require_once ($root . "/helping_supplies/includes/dbConnect.php");
$sql = "SELECT email FROM `accounts` WHERE ID = '" . $_SESSION['accountsId'] . "'";
$db_erg = mysqli_query($db_link, $sql);

while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
    $Absender = $zeile['email'];
}
//TODO aktivieren
//mail($eMail, $reason . ": " . $title, $message, "FROM: $Absender");
//Mail an eigene eMail
if (isset($_POST["mailMe"])) {
    $eMail = $Absender;
    //TODO E-Mail ändern
    $Absender = "name@ihre-domain.de";
    //TODO aktivieren
    mail($eMail, $reason . ": " . $title, "KOPIE IHRER NACHRICHT<br>" . $message, "FROM: $Absender");
}
header('Location: ' . $_POST['link']);
$_SESSION['reglog'] = "contactOk";
?>