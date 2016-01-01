<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/helping_supplies/template/head.php");
include($root . "/helping_supplies/template/header.php");

//define variables and set to empty values
$usernameErr = $passwordErr = "";
$ErrCounter = 0;

?>
<div class="container">
    <h1>Login</h1>
    <form action="" method="post">
        <table class="u-full-width">
            <tr><td>Login Name:</td><td><input maxlength="50" name="lName" type="text" required="required"></td><td><font color="red"><b><?php echo $usernameErr; ?></b></font></td></tr>
            <tr><td>Passwort:</td><td><input maxlength="255" name="password" type="text" required="required"></td><td><font color="red"><b><?php echo $passwordErr; ?></b></font></td></tr>
            <tr><td><input name="Send" type="submit" value="Login" class="button-primary"></td>
        </table>
    </form>
</div>
<?php
include($root . "/helping_supplies/template/footer.php");
?>