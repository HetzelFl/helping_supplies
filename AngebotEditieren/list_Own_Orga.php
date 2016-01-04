<?php
//$accountID = 1;
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include_once ($root . "/helping_supplies/template/head.php");
include_once ($root . "/helping_supplies/template/header.php");

$accountID = $_SESSION['accountsId'];

include '../includes/dbConnectPDO.php';
include './Edit_HTML_functions.php';


?>
<div class="container">
    <p></p>
    <h3><u>Ihre Angebote als Bereitsteller</u></h3>
    <table style="width: 100%">
        <tr align="left">
            <th>Organisation</th>
            <th>Startland</th>
            <th>Startdorf</th>
            <th>Zielland</th>
            <th>Zieldorf</th>
            <th>Verfügbar ab</th>
            <th>Produkt</th>
            <th>Kontakt</th>
            <th>Löschen</th>
        </tr>
        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idOrga"])) {

            $offerID = filterfunktion($_POST["idOrga"]);

            if ($offerID != "") {
                try {
                    deleteOrgaOffer($offerID, $accountID);
                    //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                    //header('Location: leere.php');
                } catch (Exception $e) {
                    echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                }
            }
        }
        $statement = getOwnOrga($accountID);
        $id = -1;
        $counter = 0;

        $test = $db->query($statement);
        $test->fetch();
        foreach ($iter = $db->query($statement) as $row)
        /* while($row = mysql_fetch_array($result)) */ {   //Creates a loop to loop through results                       
            if ($id != htmlspecialchars($row['id'])) {
                $id = htmlspecialchars($row['id']);
                echo "<form onSubmit=\"return\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"post\">";
                echo "<tr align=\"left\">\n";
                echo "<td>" . htmlspecialchars($row['offerer']) . "</td>\n";
                echo "<td>" . htmlspecialchars($row['startCountry']) . "</td>\n";
                echo "<td>" . htmlspecialchars($row['startVillage']) . "</td>\n";
                echo "<td>" . htmlspecialchars($row['destCountry']) . "</td>\n";
                echo "<td>" . htmlspecialchars($row['destinationVillage']) . "</td>\n";
                echo "<td>" . reformDatetoNormal(htmlspecialchars($row['startDate'])) . "</td>\n";
                echo "<td>";

                do {
                    echo htmlspecialchars($row['pr']);

                    if (($temp = $test->fetchColumn()) == $id) {
                        $row = $iter->fetch();
                        echo ", ";
                    } else {
                        break;
                    }
                } while (true);

                echo "</td>\n";
                echo "<td>" . "<a href=\"/helping_supplies/AngebotEditieren/edit_Offer_Orga_HTML.php?id=$id\">Editieren</a></td>\n";
                echo "<td>";
                echo "<input type=\"submit\" value=\"Löschen\" name=\"delete\" onclick=\"return confirm('Eintrag wirklich löschen?');this.parentNode.removeChild(this);\">";
                echo "</td>\n";
                echo "</tr>";  //$row['index'] the index here is a field name
                echo "<input name=idOrga type=hidden value='" . htmlspecialchars($row['id']) . "'>";
                echo "</form>";
            }
        }
        ?>
    </table>

    <h3><u>Ihre Angebote als Lieferer</u></h3>
    <table style="width: 100%">
        <tr align="left">
            <th>Name</th>
            <th>Startland</th>
            <th>Startdorf</th>
            <th>Zielland</th>
            <th>Zieldorf</th>
            <th>Verfügbar ab</th>
            <th>Produkt</th>
            <th>Kontakt</th>
            <th>Löschen</th>
        </tr>
        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idDeliver"])) {

                $offerID = filterfunktion($_POST["idDeliver"]);

                if ($offerID != "") {
                    try {
                        deleteDeliverOffer($offerID, $accountID);
                        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                        //header('Location: leere.php');
                    } catch (Exception $e) {
                        echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                    }
                }
        }
        $statement = getOwnDeliverer($accountID);
        $id = -1;
        $counter = 0;

        $test = $db->query($statement);
        $test->fetch();
        foreach ($iter = $db->query($statement) as $row)
        /* while($row = mysql_fetch_array($result)) */ {   //Creates a loop to loop through results                       
            if ($id != htmlspecialchars($row['id'])) {
                $id = htmlspecialchars($row['id']);
                echo "<form onSubmit=\"return\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"post\">";
                echo "<tr align=\"left\">\n";
                echo "<td>" . htmlspecialchars($row['offerer']) . "</td>\n";
                echo "<td>" . htmlspecialchars($row['startCountry']) . "</td>\n";
                echo "<td>" . htmlspecialchars($row['startVillage']) . "</td>\n";
                echo "<td>" . htmlspecialchars($row['destCountry']) . "</td>\n";
                echo "<td>" . htmlspecialchars($row['destinationVillage']) . "</td>\n";
                echo "<td>" . reformDatetoNormal(htmlspecialchars($row['startDate'])) . "</td>\n";
                echo "<td>";

                do {
                    echo htmlspecialchars($row['pr']);

                    if (($temp = $test->fetchColumn()) == $id) {
                        $row = $iter->fetch();
                        echo ", ";
                    } else {
                        break;
                    }
                } while (true);
                echo "</td>\n";
                echo "<td>" . "<a href=\"/helping_supplies/AngebotEditieren/edit_Offer_Deliver_HTML.php?id=$id\">Editieren</a></td>\n";
                echo "<td>";
                echo "<input type=\"submit\" value=\"Löschen\" name=\"delete\" onclick=\"return confirm('Eintrag wirklich löschen?');this.parentNode.removeChild(this);\">";
                echo "</td>\n";
                echo "</tr>";  //$row['index'] the index here is a field name
                echo "<input name=idDeliver type=hidden value='" . htmlspecialchars($row['id']) . "'>";
                echo "</form>";
            }
        }
        ?>
    </table>
</div>

<?php
// include footer
include_once ($root . "/helping_supplies/template/footer.php");
?>