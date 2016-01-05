<?php

$root = $_SERVER['DOCUMENT_ROOT'];
if ($_REQUEST['ID'] && $_REQUEST['Aktivierungscode']) {
    require_once ($root . "/helping_supplies/includes/dbConnect.php");
    $db_link = mysqli_connect(
            MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK
    );

    require_once ($root . "/helping_supplies/includes/functions.php");

    $_REQUEST['ID'] = filterfunktion($_REQUEST['ID']);
    $_REQUEST['Aktivierungscode'] = filterfunktion($_REQUEST['Aktivierungscode']);

    $sql = "SELECT ID FROM accounts WHERE ID = '" . $_REQUEST['ID'] . "' AND activation = '" . $_REQUEST['Aktivierungscode'] . "'";

    $db_erg = mysqli_query($db_link, $sql);

    $count = 0;

    while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
        $ID = $zeile['ID'];
        $count++;
    }

    if ($count == 1) {
        //Account aktivieren
        $sql = "UPDATE `accounts` SET `active`=TRUE WHERE ID= '" . $_REQUEST['ID'] . "'";
        mysqli_query($db_link, $sql);
        echo"Vielen Dank für Ihre Registrierung. Der Aktivierungsprozess ist nun abgeschlossen.";
    } elseif ($count == 0) {
        echo"Dieser Account ist nicht bekannt";
    }
}
?>