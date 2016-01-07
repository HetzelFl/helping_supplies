<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/helping_supplies/template/head.php");
include($root . "/helping_supplies/template/header.php");

if (!isset($_REQUEST['id']) OR ! isset($_REQUEST['typ'])) {
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=/helping_supplies/index.php\">";
    exit;
} else {
    //id und typ vorhanden
    require_once ($root . "/helping_supplies/includes/functions.php");

    $_REQUEST['id'] = filterfunktion($_REQUEST['id']);
    $_REQUEST['typ'] = filterfunktion($_REQUEST['typ']);
}

//typ korrekt?
if ($_REQUEST['typ'] == "orga" OR $_REQUEST['typ'] == "deliver") {
    $status = True;
} else {
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=/helping_supplies/index.php\">";
    exit;
}

//Daten des Angebots aus DB holen
require_once ($root . "/helping_supplies/includes/dbConnect.php");

if ($_REQUEST['typ'] == "orga") {
    $sql = "SELECT * FROM organisation_offer WHERE ID = '" . $_REQUEST['id'] . "'";
} else {
    $sql = "SELECT * FROM deliverer_offer WHERE ID = '" . $_REQUEST['id'] . "'";
}

$db_erg = mysqli_query($db_link, $sql);

$count = 0;
$ErrMessage = "";
$ErrCounter = 0;

while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
    $offerer = $zeile['offerer'];
    $eMail = $zeile['eMail'];
    $startCountry = $zeile['startCountry'];
    $startVillage = $zeile['startVillage'];
    $destinationCountry = $zeile['destinationCountry'];
    $destinationVillage = $zeile['destinationVillage'];
    $startDate = reformDatetoNormal($zeile['startDate']);
    $endDate = reformDatetoNormal($zeile['endDate']);
    $infoField = $zeile['textField'];
    if ($_REQUEST['typ'] == "orga") {
        $contact = $zeile['contact'];
    }
    $count++;
}
//Wenn falsche ID
if ($count == 0) {
    $ErrMessage = "Dieses Angebot exestiert nicht.";
    $ErrCounter++;
}

//ID in Ländernamen
$sql = "SELECT * FROM `countries`";
$db_erg = mysqli_query($db_link, $sql);
while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
    $ID = $zeile['ID'];
    if ($ID == $startCountry) {
        $startCountry = $zeile['countryName'];
    }
    if ($ID == $destinationCountry) {
        $destinationCountry = $zeile['countryName'];
    }
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
    <table class="u-full-width">
        <tr>
            <th>Organisation</th>
            <td><?php
                echo $offerer;
                ?></td>
            <th>Kontaktperson</th><?php
            if ($_REQUEST['typ'] == "orga") {
                echo "<td>";
                echo $contact;
                echo "</td>";
            }
            ?>
        </tr>
        <tr>
            <th>Verfügbar ab</th>
            <td><?php
                echo $startDate;
                ?></td>
            <th>Verfügbar bis</th>
            <td><?php
                echo $endDate;
                ?></td>
        </tr>
        <tr>
            <th>Startland</th>
            <td><?php
                echo $startCountry;
                ?></td>
            <th>Startort</th>
            <td><?php
                echo $startVillage;
                ?></td>
        </tr>
        <tr>
            <th>Zielland</th>
            <td><?php
                echo $destinationCountry;
                ?></td>
            <th>Zielort</th>
            <td><?php
                echo $destinationVillage;
                ?></td>
        </tr>
    </table>
    <p><?php
        echo $infoField;
        ?></p>



    <p><b>Mögliche Hilfsgüter: </b><?php
        $prodCount = 0;
        if ($_REQUEST['typ'] == "orga") {
            $sql = "SELECT ID_product FROM productsorgajoin WHERE ID_organisationOffer = '" . $_REQUEST['id'] . "'";
        } else {
            $sql = "SELECT ID_product FROM productsdelivererjoin WHERE ID_delivererOffer = '" . $_REQUEST['id'] . "'";
        }
        $db_erg = mysqli_query($db_link, $sql);
        while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
            if ($prodCount != 0) {
                echo ", ";
            }
            $prodCount++;
            $ID = $zeile['ID_product'];
            $sqlProd = "SELECT productname FROM products WHERE ID = '" . $ID . "'";
            $db_ergProd = mysqli_query($db_link, $sqlProd);
            while ($zeile = mysqli_fetch_array($db_ergProd, MYSQL_ASSOC)) {
                echo $zeile['productname'];
            }
        }
        ?></p>


    <form action="contact.php" method="post" style="text-align:right;">
        <input type="hidden" name="offerer" value="<?php
        echo $offerer;
        ?>">
        <input type="hidden" name="startCountry" value="<?php
        echo $startCountry;
        ?>">
        <input type="hidden" name="destinationCountry" value="<?php
        echo $destinationCountry;
        ?>">
        <input type="hidden" name="eMail" value="<?php
        echo $eMail;
        ?>">
        <input type="hidden" name="link" value="/helping_supplies/showOffer/showOffer.php?id=<?php
        echo $_REQUEST['id'];
        ?>&typ=<?php
        echo $_REQUEST['typ'];
        ?>">
        <input class="button-primary" type="submit" value="Kontaktieren">
    </form>

    <div class="responsiveGMaps">
        <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php
                echo $destinationCountry;
                ?>,<?php
                echo $destinationVillage;
                ?>&key=AIzaSyCP4tAaRU6nhhE0tdEtE3U3mqp1JJUgnwA" allowfullscreen></iframe>
    </div>
</div>

<?php
include($root . "/helping_supplies/template/footer.php");
