<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include_once ($root . "/helping_supplies/template/head.php");
include_once ($root . "/helping_supplies/template/header.php");

include './filterDelivererlistFunction.php';
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
    <h3>Angebote von Auslieferern</h3>

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
$input1;
$input2;

if (isset($_GET["filter"])){
    
    $_POST["filter"] = $_GET["filter"];
    
}
if (isset($_POST["filter"]) && $_POST["filter"] != "nichts") {
    if ($_POST["filter"] == "filterStartCountry") {

        if(isset($_GET["in1"]))
            $input1 = $_GET["in1"];
        else
            $input1 = filterfunktion($_POST["filterCountry"]);

        $statement = filterStartCountry($input1);
        
        $entries = getDBEntryCount($statement);
        
        $statement .= setLimit($startAt, $rowsPerPage);
        
        echo "Startland: " . $input1;
    } else if ($_POST["filter"] == "filterDestCountry") {
        
        if(isset($_GET["in1"]))
            $input1 = $_GET["in1"];
        else
            $input1 = filterfunktion($_POST["filterCountry"]);

        $statement = filterDestCountry($input1);
        
        $entries = getDBEntryCount($statement);
        
        $statement .= setLimit($startAt, $rowsPerPage);
        
        echo "Zielland: " . $input1;
    } else if ($_POST["filter"] == "filterDate") {

        if(isset($_GET["in1"]))
            $input1 = $_GET["in1"];
        else
            $input1 = filterfunktion($_POST["filterStartDate"]);
        
        if(isset($_GET["in2"]))
            $input2 = $_GET["in2"];
        else       
            $input2 = filterfunktion($_POST["filterEndDate"]);

        if (validateDate($input1) || validateDate($input2)) {
            
            $statement = filterDatespan(reformDatetoDB($input1), reformDatetoDB($input2));
                    
            $entries = getDBEntryCount($statement);

            $statement .= setLimit($startAt, $rowsPerPage);

            echo "Angebot gültig zwischen " . $input1 . " und " . $input2;
        } else {
            $statement = filterNone($startAt, $rowsPerPage);
            echo "Kein Filter gesetzt";
        }
    } else if ($_POST["filter"] == "filterName") {

        if(isset($_GET["in1"]))
            $input1 = $_GET["in1"];
        else
            $input1 = filterfunktion($_POST["filterInputName"]);

        if (preg_match("/^[a-zA-Z ]*$/", $input1)) {
            
            $statement = filterName($input1);
                    
            $entries = getDBEntryCount($statement);

            $statement .= setLimit($startAt, $rowsPerPage);
        
            echo "Name beinhaltet \"" . $input1 . "\"";
        } else {
            $statement = filterNone($startAt, $rowsPerPage);
            echo "Kein Filter gesetzt";
        }
    }
} else {
    $statement = filterNone();
            
    $entries = getDBEntryCount($statement);
    
    $statement .= setLimit($startAt, $rowsPerPage);
    echo "Kein Filter gesetzt";
}
?>

    <table style="width: 100%">
        <tr>
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
$id = -1;

$test = $db->query($statement);
$test->fetch();
foreach ($iter = $db->query($statement) as $row)
/* while($row = mysql_fetch_array($result)) */ {   //Creates a loop to loop through results                       
    if ($id != htmlspecialchars($row['id'])) {
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
            echo htmlspecialchars($row['pr']);

            if (($temp = $test->fetchColumn()) == $id) {
                $row = $iter->fetch();
                echo ", ";
            } else {
                break;
            }
        } while (true);
        echo "</td>\n";
        //TODO Add offerID to link below
        echo "<td>" . "<a href=\"/helping_supplies/showOffer/showOffer.php?id=$id&typ=deliver\">Info</a></td>\n";
        echo "</tr>";  //$row['index'] the index here is a field name
    }
}
?>
    </table>
    <div class="centering">
        <?php
        global $input1, $input2;
        
        $pages = ceil($entries / $rowsPerPage);
        for ($i = 1; $i <= $pages; $i++) {
            if (!isset($_POST["filter"])){
                echo "<a href=\"deliverAngebotAuflisten.php?page=$i\">$i</a>&nbsp;";
            }
            else {
                $filter = $_POST["filter"];
                echo "<a href=\"deliverAngebotAuflisten.php?page=$i&filter=$filter&in1=$input1&in2?$input2\">$i</a>&nbsp;";
            }
        }
        ?>
    </div>
</div>

        <?php
// include footer
        include_once ($root . "/helping_supplies/template/footer.php");
        ?>