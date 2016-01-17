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
$usernameErr = $nameErr = $eMailErr = $websiteErr = "";

//Daten des Angebots aus DB holen
require_once ($root . "/helping_supplies/includes/dbConnect.php");

if (isset($_REQUEST['Send'])) {
    $ErrCounter = 0;

    $username = filterfunktion($_REQUEST["lName"]);
    $name = filterfunktion($_REQUEST["name"]);
    $eMail = filterfunktion($_REQUEST["eMail"]);
    $oldUsername = filterfunktion($_REQUEST["oldUsername"]);
    $oldName = filterfunktion($_REQUEST["oldName"]);
    $oldEMail = filterfunktion($_REQUEST["oldEMail"]);
    $website = filterfunktion($_REQUEST["website"]);

    if (!check_email($eMail)) {
        $eMailErr = "Üngültige E-Mail";
        $ErrCounter++;
    }

    $sql = "SELECT username,name,email FROM accounts";
    $db_erg = mysqli_query($db_link, $sql);
    while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {

        if ($zeile['username'] == $username) {
            if ($username != $oldUsername) {
                $usernameErr = "Login Name bereits vergeben";
                $ErrCounter++;
            }
        }
        if ($zeile['name'] == $name) {
            if ($name != $oldName) {
                $nameErr = "Name bereits vergeben";
                $ErrCounter++;
            }
        }
        if ($zeile['email'] == $eMail) {
            if ($eMail != $oldEMail) {
                $nameErr = "eMail bereits vergeben";
                $ErrCounter++;
            }
        }
    }
    if ($eMail != $oldEMail OR $name != $oldName OR $username != $oldUsername) {

        if ($ErrCounter == 0) {
            $sql = "UPDATE `accounts` SET `username` = '" . $username . "', `email` = '" . $eMail . "', `name` = '" . $name . "', `website` = '" . $website . "' WHERE `ID` = " . $_SESSION['accountsId'] . ";";
            mysqli_query($db_link, $sql);
            $_SESSION['reglog'] = "aktualisiert";
        }
    }
}

$sql = "SELECT * FROM accounts WHERE ID = '" . $_SESSION['accountsId'] . "'";
$db_erg = mysqli_query($db_link, $sql);

while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
    $username = $zeile['username'];
    $eMail = $zeile['email'];
    $name = $zeile['name'];
    $website = $zeile['website'];
}
//include header für Infobox
include($root . "/helping_supplies/template/header.php");
?>
<div class="container">
    <h1>Account bearbeiten</h1>
    <form action="" method="post">
        <table class="u-full-width">
            <tr><td>Login Name:</td><td><input maxlength="50" name="lName" value="<?php echo $username; ?>" type="text" required="required"></td><td><font color="red"><b><?php echo $usernameErr; ?></b></font></td></tr>
            <tr><td>Angezeigter Name:</td><td><input maxlength="255" name="name" value="<?php echo $name; ?>" type="text" required="required"></td><td><font color="red"><b><?php echo $nameErr; ?></b></font></td></tr>
            <tr><td>E-Mail:</td><td><input maxlength="50" name="eMail" value="<?php echo $eMail; ?>" type="email" required="required"></td><td><font color="red"><b><?php echo $eMailErr; ?></b></font></td></tr>
            <tr><td>Website:</td><td><input maxlength="100" name="website" value="<?php echo $website; ?>" type="text"></td><td><font color="red"><b><?php echo $websiteErr; ?></b></font></td></tr>
            <input type="hidden" name="oldUsername" value="<?php
            echo $username;
            ?>">
            <input type="hidden" name="oldName" value="<?php
            echo $name;
            ?>">
            <input type="hidden" name="oldEMail" value="<?php
            echo $eMail;
            ?>">
            <tr><td><input name="Send" type="submit" value="Speichern" class="button-primary"></td>
        </table>
    </form>
    <a href="/helping_supplies/account/edit-password.php"><button class="button">Passwort ändern</button></a>
</div>

<?php
include($root . "/helping_supplies/template/footer.php");
?>