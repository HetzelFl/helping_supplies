<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/helping_supplies/template/head.php");
include($root . "/helping_supplies/template/header.php");

//Keine Regestrierung wenn User bereits eingeloggt ist
if (isset($_SESSION['accountsId'])) {
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=/helping_supplies/index.php\">";
}
//define variables and set to empty values
$usernameErr = $nameErr = $eMailErr = $passwordErr = "";
$ErrCounter = 1;

//TODO E-Mail ändern
$Absender = "name@ihre-domain.de";

if (isset($_REQUEST['Send'])) {
    $ErrCounter = 0;

    $username = filterfunktion($_REQUEST["lName"]);
    $name = filterfunktion($_REQUEST["name"]);
    $password = filterfunktion($_REQUEST["password"]);
    $password2 = filterfunktion($_REQUEST["password2"]);
    $eMail = filterfunktion($_REQUEST["eMail"]);

    if ($password == $password2) {
        $password = password_hash($password, PASSWORD_BCRYPT);
    } else {

        $passwordErr = "Passwörter stimmen nicht überein";
        $ErrCounter++;
    }

    if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
        $eMailErr = "Üngültige E-Mail";
        $ErrCounter++;
    }

    require_once ($root . "/helping_supplies/includes/dbConnect.php");

    $sql = "SELECT username,name FROM accounts";
    $db_erg = mysqli_query($db_link, $sql);
    while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {

        if ($zeile['username'] == $username) {
            $usernameErr = "Login Name bereits vergeben";
            $ErrCounter++;
        }
        if ($zeile['name'] == $name) {
            $nameErr = "Name bereits vergeben";
            $ErrCounter++;
        }
    }

    if ($ErrCounter == 0) {
        $Aktivierungscode = filterfunktion(zufallsstring(15));

        //mysql_query($db_link, "INSERT INTO `accounts` (`ID`, `username`, `passwort`, `email`, `name`, `website`, `activation`, `active`) VALUES (NULL, '" . $username . "', '" . $password . "', '" . $eMail . "', '" . $name . "', NULL, '" . $Aktivierungscode . "', 'FALSE')");
        $sql = "INSERT INTO `accounts` (`ID`, `username`, `passwort`, `email`, `name`, `website`, `activation`, `active`) VALUES (NULL, '" . $username . "', '" . $password . "', '" . $eMail . "', '" . $name . "', NULL, '" . $Aktivierungscode . "', 'FALSE')";
        mysqli_query($db_link, $sql);

        $sql = "SELECT MAX(`ID`) FROM `accounts`";
        $db_erg = mysqli_query($db_link, $sql);

        while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
            $ID = $zeile['MAX(`ID`)'];
        }
        //TODO aktivieren
        //mail($_REQUEST['EMail'], "Registrierung abschließen", "Hallo,\n\num die Registrierung abzuschließen, klicken Sie bitte auf den folgenden Link:\n\nhttp://www.ihre-domain.de/regestration/reg-aktivieren.php?ID=" . $ID . "&Aktivierungscode=" . $Aktivierungscode . "", "FROM: $Absender");
        //echo "Hallo,\n\num die Registrierung abzuschließen, klicken Sie bitte auf den folgenden Link:\n\nhttp://www.ihre-domain.de/registration/reg-aktivieren.php?ID=" . $ID . "&Aktivierungscode=" . $Aktivierungscode . "";
        $_SESSION['reglog'] = "reg";
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=/helping_supplies/index.php\">";
    }
}
if ($ErrCounter > 0) {
    ?>
    <div class="container">
        <h1>Regestrierung</h1>
        <form action="" method="post">
            <table class="u-full-width">
                <tr><td>Login Name:</td><td><input maxlength="50" name="lName" type="text" required="required"></td><td><font color="red"><b><?php echo $usernameErr; ?></b></font></td></tr>
                <tr><td>Angezeigter Name:</td><td><input maxlength="255" name="name" type="text" required="required"></td><td><font color="red"><b><?php echo $nameErr; ?></b></font></td></tr>
                <tr><td>Passwort:</td><td><input maxlength="255" name="password" type="password" required="required"></td><td><font color="red"><b><?php echo $passwordErr; ?></b></font></td></tr>
                <tr><td>Passwort Wiederholung:</td><td><input maxlength="255" name="password2" type="password" required="required"></td><td><font color="red"><b><?php echo $passwordErr; ?></b></font></td></tr>
                <tr><td>E-Mail:</td><td><input maxlength="50" name="eMail" type="email" required="required"></td><td><font color="red"><b><?php echo $eMailErr; ?></b></font></td></tr>
                <tr><td><input name="Send" type="submit" value="Absenden" class="button-primary"></td>
            </table>
        </form>
    </div>
    <?php
}
include($root . "/helping_supplies/template/footer.php");
?>