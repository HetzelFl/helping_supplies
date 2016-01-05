<?php

session_start();

if (isset($_SESSION['accountsId'])) {

    require_once ($root . "/helping_supplies/includes/dbConnect.php");

//Get Activation Code from User
    $sql = "SELECT activation,active FROM `accounts` Where ID='" . $_SESSION['accountsId'] . "'";
    $db_erg = mysqli_query($db_link, $sql);

    while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
        $accountsActivation = $zeile['activation'];
        $accountsActive = $zeile['active'];
    }

//Fals gerade frisch eingeloggt oder gast
    if (!isset($_SESSION['accountsActivation'])) {
        $_SESSION['accountsActivation'] = $accountsActivation;
    }
//Zufallszahl zur Vermeidung von Cookie Diebstahl.
    if ($_SESSION['accountsActivation'] == $accountsActivation & $accountsActive == TRUE) {
        //Wenn Cookie okay
        require_once ($root . "/helping_supplies/includes/functions.php");
        $Aktivierungscode = zufallsstring(15);

        // Eintragen in DB
        $sql = "UPDATE `accounts` SET `activation`='" . $Aktivierungscode . "' WHERE ID ='" . $_SESSION['accountsId'] . "'";
        mysqli_query($db_link, $sql);
        $_SESSION['accountsActivation'] = $Aktivierungscode;
        $_SESSION['uCStatus'] = "OK";
    } elseif ($accountsActive == FALSE) {
        //Wenn Account nicht aktiviert  
        session_destroy();
        session_start();

        //TODO ggf durch Ausgabe in Infobox ersetzen
        $_SESSION['uCStatus'] = "Account nicht aktiv";
    } else {
        //Wenn Cookie gestohlen oder veraltet
        session_destroy();
        session_start();
        $_SESSION['uCStatus'] = "Fehler";
    }
}