<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/helping_supplies/template/head.php");
include($root . "/helping_supplies/template/header.php");

//Kein Login wenn User bereits eingeloggt ist
if (isset($_SESSION['accountsId'])) {
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=/helping_supplies/index.php\">";
    exit;
}
//define variables and set to empty values
$ErrCounter = 0;
$ErrMessage = "";

if (isset($_REQUEST['Send'])) {
//define variables and set to empty values
    $usernameErr = $passwordErr = "";

    require_once ($root . "/helping_supplies/includes/functions.php");
    $username = filterfunktion($_REQUEST["lName"]);
    $passwordIN = filterfunktion($_REQUEST["password"]);

//Get Data from User
    require_once ($root . "/helping_supplies/includes/dbConnect.php");

    $sql = "SELECT ID,passwort,activation,active FROM `accounts` Where username='" . $username . "'";
    $db_erg = mysqli_query($db_link, $sql);

    $count = 0;
    while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
        $passwordDB = $zeile['passwort'];
        $accountsId = $zeile['ID'];
        $accountsActivation = $zeile['activation'];
        $accountsActive = $zeile['active'];
        $count++;
    }

    if ($count == 1) {
        if (password_verify($passwordIN, $passwordDB)) {
            if ($accountsActive) {
                $_SESSION['accountsId'] = $accountsId;
                $_SESSION['accountsActivation'] = $accountsActivation;
                $_SESSION['accountsUsername'] = $username;
                $_SESSION['reglog'] = "login";
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=/helping_supplies/index.php\">";
            } else {
                $ErrMessage = "<font color=\"red\"><b>Ihr Account wurde noch nicht aktiviert.</b></font>";
            }
        } else {
            //Falsches Passwort
            $ErrCounter++;
        }
    } else {
        //Falscher Name
        $ErrCounter++;
    }
    if ($ErrCounter != 0) {
        $ErrMessage = "<font color=\"red\"><b>Ihre Eingabe ist nicht gültig.</b></font>";
    }
}
?>
<div class="container">
    <h1>Login</h1>
    <?php echo $ErrMessage; ?>
    <form action="" method="post">
        <table class="u-full-width">
            <tr><td>Login Name:</td><td><input maxlength="50" name="lName" type="text" required="required"></td></tr>
            <tr><td>Passwort:</td><td><input maxlength="255" name="password" type="password" required="required"></td></tr>
            <tr><td><input name="Send" type="submit" value="Login" class="button-primary"></td>
        </table>
    </form>
</div>
<?php
include($root . "/helping_supplies/template/footer.php");
?>