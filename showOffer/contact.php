<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/helping_supplies/template/head.php");
include($root . "/helping_supplies/template/header.php");

//Kontrolle ob Formular erlaubt aufgerufen wurde
if (!isset($_POST['link'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
if (!isset($_SESSION['accountsId'])) {
    header('Location: ' . $_POST['link']);
    $_SESSION['reglog'] = "noAccess";
    exit;
}

if (isset($_REQUEST['Send'])) {
    $title = filterfunktion($_REQUEST["title"]);
    $reason = filterfunktion($_REQUEST["reason"]);
    $message = filterfunktion($_REQUEST["message"]);
    $mailMe = $_REQUEST["mailMe"];
    $eMail = filterfunktion($_REQUEST["eMail"]);
echo $mailMe;
    //TODO E-Mail ändern
    $Absender = "name@ihre-domain.de";
    //TODO aktivieren
    //mail($eMail, $reason . ": " . $title, $message, "FROM: $Absender");

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    $_SESSION['reglog'] = "contactOk";
} else {
    $offerer = $_POST['offerer'];
    $startCountry = $_POST['startCountry'];
    $destinationCountry = $_POST['destinationCountry'];
    $eMail = $_POST['eMail'];
    $link = $_POST['link'];
}
?>

<div class="container">
    <h1><?php
        echo $offerer;
        echo ": Von ";
        echo $startCountry;
        echo " nach ";
        echo $destinationCountry;
        ?></h1>
    <form action="contact-confirmation.php" method="post">
        <div class="row">
            <div class="six columns">
                <label for="title">Titel</label>
                <input class="u-full-width" type="textfield" value="<?php
                echo $offerer;
                echo ": Von ";
                echo $startCountry;
                echo " nach ";
                echo $destinationCountry;
                ?>" name="title" required="required">
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
        <label for="Message">Nachricht</label>
        <textarea class="u-full-width" placeholder="Ihre Nachricht..." name="message" required="required"></textarea>
        <label class="send-yourself-copy">
            <input type="checkbox" name="mailMe">
            <span class="label-body">Eine Kopie an mich selbst senden</span>
        </label>
        <input type="hidden" name="eMail" value="<?php
        echo $eMail;
        ?>">
        <input type="hidden" name="link" value="<?php
        echo $link;
        ?>">
        <input name="Send" type="submit" value="Absenden" class="button-primary">
    </form>
</div>

<?php
include($root . "/helping_supplies/template/footer.php");
?>