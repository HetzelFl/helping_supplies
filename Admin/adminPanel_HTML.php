<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include_once ($root . "/helping_supplies/template/head.php");

include '../includes/dbConnectPDO.php';
include './adminPanelFunctions.php';
?>
<p></p>
<div class="container">
    <!-- DELETE COUNTRY -->
    <div class="columns five">
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <h3>Land entfernen</h3>

            <label>Länder:</label> 

            <p> <select name="startCountry" >
                    <?php
                    selectCountryDropbox();
                    ?> 
                </select> 
            </p>
            <input type="submit" value="Löschen">

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["startCountry"])) {

                $startCountry = filterfunktion($_POST["startCountry"]);

                if ($startCountry != "") {
                    try {
                        echo $startCountry . " wurde entfernt.";
                        //deleteCountry($startCountry)
                        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                        //header('Location: leere.php');
                    } catch (Exception $e) {
                        echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                    }
                }
            }
            ?>
        </form>

        <!-- ADD NEW COUNTRY -->
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <h3>Land hinzufügen</h3>

            <p>
                <label>Länderabkürzung: </label>
                <input type="text" name="abbreviation" value="<?php if (isset($_POST["abbreviation"])) echo $_POST["abbreviation"]; ?>" required="required" />
            </p>
            <p>
                <label>Ländername: </label>
                <input type="text" name="country" value="<?php if (isset($_POST["country"])) echo $_POST["country"]; ?>" required="required" />

            </p>
            <input type="submit" value="Hinzufügen">

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["country"]) && isset($_POST["abbreviation"])) {

                //global $country, $abbreviation;
                $country = filterfunktion($_POST["country"]);
                $abbreviation = filterfunktion($_POST["abbreviation"]);

                if (preg_match("/^[a-zA-Z ]*$/", $abbreviation) && preg_match("/^[a-zA-Z ]*$/", $country)) {
                    if ($_POST["country"] != "" && $_POST["abbreviation"] != "") {
                        try {
                            echo "Test";
                            //create_Offer($table, $name, $contact, $eMail, $startCountry, $startVillage, $destCountry, $destVillage, reformDate($startDate), reformDate($endDate), $products);
                            //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                            header('Location: leere.php');
                        } catch (Exception $e) {
                            echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                        }
                    }
                } else {
                    echo $countryErr;
                    $countryErr = "Bitte nur Buchstaben und Leerzeichen verwenden.";
                }
            }
            ?>
        </form>
    </div>

    <!-- DELETE PRODUCT -->
    <div class="columns five">
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <h3>Produkt entfernen</h3>
            <label>Produkte:</label> 

            <p> <select name="product" >

                    <?php
                    selectProductDropbox();
                    ?> 
                </select> 
            </p> 

            <input type="submit" value="Löschen">

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product"])) {

                $product = filterfunktion($_POST["product"]);

                if ($_POST["product"] != "") {
                    try {
                        echo (deleteProduct($product));
                        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                        //header('Location: leere.php');
                    } catch (Exception $e) {
                        echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                    }
                } else
                    echo "TEST";
            }
            ?>
        </form>

        <!-- ADD PRODUCT -->
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <h3>Produkt hinzufügen</h3>

            <label>Produkte:</label> 
            <p><input type="text" name="productAdd"> </p>

            <input type="submit" value="Hinzufügen">

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productAdd"])) {

                $productAdd = filterfunktion($_POST["productAdd"]);

                if ($_POST["productAdd"] != "") {
                    try {
                        echo (addProduct($productAdd));
                        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                        //header('Location: leere.php');
                    } catch (Exception $e) {
                        echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                    }
                } else
                    echo "TEST";
            }
            ?>
        </form>
    </div>
</div>

<?php //List of all Offers ?>
<div class="container">

    <p></p>
    <h3><u>Die Angebote von Bereitsteller</u></h3>
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
        </tr>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idOrga"])) {

            $offerID = filterfunktion($_POST["idOrga"]);

            if ($offerID != "") {
                try {
                    echo "Angebot Nummer " . $offerID . " wurde entfernt.";
                    deleteOrgaOffer($offerID);
                    //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                    //header('Location: leere.php');
                } catch (Exception $e) {
                    echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                }
            }
        }

        $statement = getAllOrga();
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
                echo "<td>" . "<input type=\"submit\" value=\"Löschen\" name=\"delete\" onclick=\"return confirm('Eintrag wirklich löschen?');this.parentNode.removeChild(this);\"></td>\n";
                echo "</tr>";  //$row['index'] the index here is a field name
                echo "<input name=idOrga type=hidden value='" . htmlspecialchars($row['id']) . "'>";
                echo "</form>";
            }
        }
        ?>
    </table>

    <h3><u>Die Angebote von Lieferer</u></h3>
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
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idDeliver"])) {

            $offerID = filterfunktion($_POST["idDeliver"]);

            if ($offerID != "") {
                try {
                    echo "Angebot Nummer " . $offerID . " wurde entfernt.";
                    deleteDeliverOffer($offerID);
                    //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                    //header('Location: leere.php');
                } catch (Exception $e) {
                    echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                }
            }
        }

        $statement = getAllDeliverer();
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
                echo "<td>" . "<input type=\"submit\" value=\"Löschen\" name=\"delete\" onclick=\"return confirm('Eintrag wirklich löschen?');this.parentNode.removeChild(this);\"></td>\n";
                echo "</tr>";  //$row['index'] the index here is a field name
                echo "<input name=idDeliver type=hidden value='" . htmlspecialchars($row['id']) . "'>";
                echo "</form>";
            }
        }
        ?>
    </table>

</div>
</body>
</html>