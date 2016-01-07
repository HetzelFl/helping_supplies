<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/helping_supplies/template/head.php");
include($root . "/helping_supplies/template/header.php");

$Absender = "";
//eMail des Users aus DB holen
if (isset($_SESSION['accountsId'])) {
    require_once ($root . "/helping_supplies/includes/dbConnect.php");
    $sql = "SELECT email FROM `accounts` WHERE ID = '" . $_SESSION['accountsId'] . "'";
    $db_erg = mysqli_query($db_link, $sql);

    while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
        $Absender = $zeile['email'];
    }
}
?>

<div class="container">
    <h1>Kontaktieren</h1>
    <form action="contact-confirmation.php" method="post">
        <div class="row">
            <div class="six columns">
                <label for="title">Titel</label>
                <input class="u-full-width" type="textfield" name="title" required="required">
            </div>
            <div class="six columns">
                <label for="reason">Grund der Nachricht</label>
                <select class="u-full-width" name="reason" required="required">
                    <option value="Fragen">Fragen</option>
                    <option value="Probleme">Probleme</option>
                    <option value="Feedback">Feedback</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                <label for="title">Ihre E-mail</label>
                <input class="u-full-width" type="email" name="Absender" <?php
echo "value=\"" . $Absender . "\"";
?> required="required">
            </div>
        </div>

        <label for="Message">Nachricht</label>
        <textarea class="u-full-width" placeholder="Ihre Nachricht..." name="message" required="required"></textarea>
        <label class="send-yourself-copy">
            <input type="checkbox" name="mailMe">
            <span class="label-body">Eine Kopie an mich selbst senden</span>
        </label>
        <input name="Send" type="submit" value="Absenden" class="button-primary">
    </form>
</div>

<?php
include($root . "/helping_supplies/template/footer.php");
?>