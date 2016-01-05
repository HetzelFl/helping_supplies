<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/helping_supplies/template/head.php");
include($root . "/helping_supplies/template/header.php");

//define variables and set to empty values
$usernameErr = $passwordErr = "";

if (isset($_REQUEST['Send'])) {
//define variables and set to empty values
    $usernameErr = $passwordErr = "";

    require_once ($root . "/helping_supplies/includes/functions.php");
    $username = filterfunktion($_REQUEST["lName"]);
    $passwordIN = filterfunktion($_REQUEST["password"]);

//Get Data from User
    require_once ($root . "/helping_supplies/includes/dbConnect.php");

    $sql = "SELECT ID,passwort,activation FROM `accounts` Where username='" . $username . "'";
    $db_erg = mysqli_query($db_link, $sql);

    $count = 0;
    while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
        $passwordDB = $zeile['passwort'];
        $accountsId = $zeile['ID'];
        $accountsActivation = $zeile['activation'];
        $count++;
    }

    if ($count == 1) {
        if (password_verify($passwordIN, $passwordDB)) {
            $_SESSION['accountsId'] = $accountsId;
            $_SESSION['accountsActivation'] = $accountsActivation;
            $_SESSION['accountsUsername'] = $username;
            $_SESSION['reglog'] = "login";
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=/helping_supplies/index.php\">";
        } else {
            $passwordErr = "Passwort falsch";
        }
    } else {
        $usernameErr = "Name unbekannt";
    }
}
?>
<div class="container">
    <h1>Login</h1>
    <form action="" method="post">
        <table class="u-full-width">
            <tr><td>Login Name:</td><td><input maxlength="50" name="lName" type="text" required="required"></td><td><font color="red"><b><?php echo $usernameErr; ?></b></font></td></tr>
            <tr><td>Passwort:</td><td><input maxlength="255" name="password" type="password" required="required"></td><td><font color="red"><b><?php echo $passwordErr; ?></b></font></td></tr>
            <tr><td><input name="Send" type="submit" value="Login" class="button-primary"></td>
        </table>
    </form>
</div>
<?php
include($root . "/helping_supplies/template/footer.php");
?>