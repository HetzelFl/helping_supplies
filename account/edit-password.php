<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head
include($root . "/helping_supplies/template/head.php");

if (!isset($_SESSION['accountsId'])) {
    header('Location: ' . $_POST['link']);
    $_SESSION['reglog'] = "noAccess";
    exit;
}

//define variables and set to empty values
$oldPasswordErr = $passwordErr = "";

//Daten des Angebots aus DB holen
require_once ($root . "/helping_supplies/includes/dbConnect.php");

if (isset($_REQUEST['Send'])) {
    $ErrCounter = 0;

    $oldPassword = filterfunktion($_REQUEST["oldPassword"]);
    $password = filterfunktion($_REQUEST["password"]);
    $password2 = filterfunktion($_REQUEST["password2"]);


    if ($password == $password2) {
        $password = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $passwordErr = "Passwörter stimmen nicht überein";
        $ErrCounter++;
    }

    if ($ErrCounter == 0) {
        $sql = "UPDATE `accounts` SET `passwort` = '" . $password . "' WHERE `ID` = " . $_SESSION['accountsId'] . ";";
        mysqli_query($db_link, $sql);
        $_SESSION['reglog'] = "PWAktualisiert";
    }
}

//include header für Infobox
include($root . "/helping_supplies/template/header.php");
?>
<div class="container">
    <h1>Passwort ändern</h1>
    <form action="" method="post">
        <table class="u-full-width">
            <tr><td>altes Passwort:</td><td><input maxlength="255" name="oldPassword" type="password" required="required"></td><td><font color="red"><b><?php echo $oldPasswordErr; ?></b></font></td></tr>
            <tr><td>neues Passwort:</td><td><input maxlength="255" name="password" type="password" required="required"></td><td><font color="red"><b><?php echo $passwordErr; ?></b></font></td></tr>
            <tr><td>neues Passwort Wiederholung:</td><td><input maxlength="255" name="password2" type="password" required="required"></td><td><font color="red"><b><?php echo $passwordErr; ?></b></font></td></tr>
            <input type="hidden" name="oldEMail" value="<?php
            echo $eMail;
            ?>">
            <tr><td><input name="Send" type="submit" value="Speichern" class="button-primary"></td>
                </form>
                <td><a href="/helping_supplies/account/edit-account.php"><button class="button">Zurück</button></a></td></tr>
        </table>
</div>

<?php
include($root . "/helping_supplies/template/footer.php");
?>