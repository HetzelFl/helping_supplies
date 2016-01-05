<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include_once ($root . "/helping_supplies/template/head.php");
include_once ($root . "/helping_supplies/template/header.php");

include './filterOrgalistFunction.php';
include '../includes/dbConnectPDO.php';
include '../AngebotEditieren/Edit_HTML_functions.php';

$entries = 20;
$rowsPerPage = 10;

$startAt = 0;
$page = 1;
if (isset($_GET["page"])) {

    $page = $_GET["page"];
    $startAt = ($page - 1) * $rowsPerPage;
}
?>
<div class="container">
    <p></p>
    <h3>Angebote von Bereitstellern</h3>

    <div class="row">
        <a href="#hide1" class="hide" id="hide1">Filter</a>
        <a href="#show1" class="show" id="show1">Ausblenden</a>
        <div class="list">
            <ul>
                <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <p><input type="radio" name="filter" value="nichts" checked="checked"> Nichts</p>
                    <p><input type="radio" name="filter" value="filterStartCountry"/> Startland&nbsp;
                        <input type="radio" name="filter" value="filterDestCountry"/> Zielland</p> <select name="filterCountry"><?php selectCountryDropbox(); ?></select>
                    <p><input type="radio" name="filter" value="filterDate"/> Datum:</p> <p>Start:&nbsp;<input type="date" name="filterStartDate" value="<?php echo date('d.m.Y') ?>">  Ende:&nbsp;<input type="date" name="filterEndDate"></p>
                    <p><input type="radio" name="filter" value="filterName"/> Name:&nbsp;<input type="date" name="filterInputName"/></p>

                    <input type="submit" title="Filter" value="Filter"> 
                </form>
            </ul>
        </div>
    </div>   
<?php

include './filterPreparation.php';

?>

    <table style="width: 100%">
        <tr>
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
$id = -1;

foreach ($test = $db->query($statement2) as $row2){//$test->fetch();
    foreach ($iter = $db->query($statement) as $row)
/* while($row = mysql_fetch_array($result)) */ {   //Creates a loop to loop through results                       
    //if ($id != htmlspecialchars($row['id'])) {
        $id = htmlspecialchars($row['id']);
        echo "<tr>\n";
        echo "<td>" . htmlspecialchars($row['offerer']) . "</td>\n";
        echo "<td>" . htmlspecialchars($row['startCountry']) . "</td>\n";
        echo "<td>" . htmlspecialchars($row['startVillage']) . "</td>\n";
        echo "<td>" . htmlspecialchars($row['destCountry']) . "</td>\n";
        echo "<td>" . htmlspecialchars($row['destinationVillage']) . "</td>\n";
        echo "<td>" . reformDatetoNormal(htmlspecialchars($row['startDate'])) . "</td>\n";
        echo "<td>";

        do {
            while ($row2['id'] != $id)
                $row2 = $test->fetch();
            
            echo htmlspecialchars($row2['pr']);

            $row2 = $test->fetch();
            if ($row2['id'] == $id) {
                //$row = $iter->fetch();
                echo ", ";
            } else {
                break;
            }
        } while (true);
        echo "</td>\n";
        //TODO Add offerID to link below
        echo "<td>" . "<a href=\"/helping_supplies/showOffer/showOffer.php?id=$id&typ=orga\">Info</a></td>\n";
        echo "</tr>";  //$row['index'] the index here is a field name
    }
    break;
}
?>
    </table>
    <div class="centering">
        <?php
        global $input1, $input2;
        
        $pages = ceil($entries / $rowsPerPage);
        for ($i = 1; $i <= $pages; $i++) {
            if (!isset($_POST["filter"])){
                echo "<a href=\"orgaAngebotAuflisten.php?page=$i\">$i</a>&nbsp;";
            }
            else {
                $filter = $_POST["filter"];
                echo "<a href=\"orgaAngebotAuflisten.php?page=$i&filter=$filter&in1=$input1&in2=$input2\">$i</a>&nbsp;";
            }
        }
        ?>
    </div>
</div>

        <?php
// include footer
        include_once ($root . "/helping_supplies/template/footer.php");
        ?>