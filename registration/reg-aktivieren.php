<?php

if ($_REQUEST['ID'] && $_REQUEST['Aktivierungscode']) {
    require_once ($root . "/Paul-flo/includes/konfiguration.php");
    $db_link = mysqli_connect(
            MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK
    );

    $_REQUEST['ID'] = mysql_real_escape_string($_REQUEST['ID']);
    $_REQUEST['Aktivierungscode'] = mysql_real_escape_string($_REQUEST['Aktivierungscode']);

    $ResultPointer = mysql_query($db_link, "SELECT ID FROM accounts WHERE ID = '" . $_REQUEST['ID'] . "' AND activation = '" . $_REQUEST['Aktivierungscode'] . "'");

    if (mysql_num_rows($ResultPointer) > 0) {
        @mysql_query($db_link, "UPDATE accounts SET active = TRUE WHERE ID = '" . $_REQUEST['ID'] . "'");
        echo"Vielen Dank für Ihre Registrierung. Der Aktivierungsprozess ist nun abgeschlossen.";
    }
}
?>