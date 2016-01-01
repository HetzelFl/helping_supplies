<?php

session_start();

$_SESSION['accountsId'] = 1;

require_once ($root . "/helping_supplies/includes/dbConnect.php");
$sql = "SELECT username,name FROM accounts";
$db_erg = mysqli_query($db_link, $sql);

//Get Activation Code from User
$sql = "SELECT activation FROM `accounts` Where ID='" . $_SESSION['accountsId'] . "'";
$db_erg = mysqli_query($db_link, $sql);



while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
    $accountsActivation = $zeile['activation'];
}

//TODO Durch Login Funktion ersetzten
//Fals gerade frisch eingeloggt
if (!isset($_SESSION['accountsActivation'])) {
    $_SESSION['accountsActivation'] = $accountsActivation;
}
//Zufallszahl zur Vermeidung von Cookie Diebstahl.
if ($_SESSION['accountsActivation'] == $accountsActivation) {
    //Wenn Cookie okay
    require_once ($root . "/helping_supplies/includes/functions.php");
    $Aktivierungscode = zufallsstring(15);

    // Eintragen in DB
    $sql = "UPDATE `accounts` SET `activation`='" . $Aktivierungscode . "' WHERE ID ='" . $_SESSION['accountsId'] . "'";
    mysqli_query($db_link, $sql);
    $_SESSION['accountsActivation'] = $Aktivierungscode;
    
}  else {
    //Wenn Cookie gestohlen oder veraltet
    session_destroy();
    session_start();
}