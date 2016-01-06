<?php

$up = "<div id='jumbotron'>
    <div class=\"container\">";
$down = "   </div>
</div>";

//Infobox nicht anzeigen wenn eingeloggt oder im registration Verzeichnis
if (isset($_SESSION['reglog'])) {
    if ($_SESSION['reglog'] != "") {
        $message = "";
        if ($_SESSION['reglog'] == "login") {
            $messageAdmin = "";
            if (isset($_SESSION['accountsAdmin'])) {
                $messageAdmin = "<b>als Admin</b>";
            }
            $message = "<h3>Sie sind eingeloggt</h3>
            <p>
                Hallo " . $_SESSION['accountsUsername'] . "! <br> Sie haben sich erfolgreich " . $messageAdmin . " eingeloggt.
            </p>";
            $_SESSION['reglog'] = "";
        } elseif ($_SESSION['reglog'] == "reg") {
            $message = "<h3>Registrierung</h3>
            <p>
            Um die Registrierung abzuschließen, rufen Sie Ihr E-Mail-Postfach ab und klicken Sie auf den Aktivierungslink in der soeben an Sie versandten E-Mail.
            </p>";
            session_destroy();
        }  elseif ($_SESSION['reglog'] == "reg-false") {
            $message = "<h3>Registrierung</h3>
            <p>
            Dieser Aktivierungslink ist nicht gültig.
            </p>";
            session_destroy();
        }  elseif ($_SESSION['reglog'] == "reg-akti") {
            $message = "<h3>Registrierung</h3>
            <p>
            Vielen Dank für Ihre Registrierung. Der Aktivierungsprozess ist nun abgeschlossen.
            Sie können sich nun einloggen.
            </p>
            <a href=\"/helping_supplies/registration/login.php\"><button class=\"button-primary\">Login</button></a>";
            session_destroy();
        } elseif ($_SESSION['reglog'] == "logout") {
            $message = "<h3>Logout</h3>
            <p>
            Sie haben sich erfolgreich ausgeloggt.
            </p>";
            session_destroy();
        }
    } else {
        $up = "";
        $message = "";
        $down = "";
    }
} else {
    $message = "        <h3>Sie sind nicht eingeloggt</h3>
        <p>
            Um die Seite in vollem Umfang nutzen zu können loggen Sie sich bitte ein oder regestriren Sie sich.
        </p>
        <a href=\"/helping_supplies/registration/login.php\"><button class=\"button-primary\">Login</button></a>
        <a href=\"/helping_supplies/registration/reg.php\"><button class=\"button\">Regestrieren</button></a>";
}
echo $up;
echo$message;
echo $down;
?>

