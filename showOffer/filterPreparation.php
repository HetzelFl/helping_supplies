<?php

global $statement, $statement2;

$statement2 = filterNone(). " ORDER BY id ";

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
        
        $statement .= " GROUP BY id ";
        $entries = getDBEntryCount($statement);
        
        $statement .= setLimit($startAt, $rowsPerPage);
        
        echo "Startland: " . $input1;
    } else if ($_POST["filter"] == "filterDestCountry") {
        
        if(isset($_GET["in1"]))
            $input1 = $_GET["in1"];
        else
            $input1 = filterfunktion($_POST["filterCountry"]);

        $statement = filterDestCountry($input1);
        
        $statement .= " GROUP BY id ";
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
                    
            $statement .= " GROUP BY id ";
            $entries = getDBEntryCount($statement);

            $statement .= setLimit($startAt, $rowsPerPage);

            echo "Angebot gültig zwischen " . $input1 . " und " . $input2;
        } else {
            $statement = filterNone();

            $statement .= " GROUP BY id ";
            $entries = getDBEntryCount($statement);

            $statement .= setLimit($startAt, $rowsPerPage);
            echo "Kein Filter gesetzt";
        }
    } else if ($_POST["filter"] == "filterName") {

        if(isset($_GET["in1"]))
            $input1 = $_GET["in1"];
        else
            $input1 = filterfunktion($_POST["filterInputName"]);

        if (preg_match("/^[a-zA-Z ]*$/", $input1)) {
            
            $statement = filterName($input1);
                 
            $statement .= " GROUP BY id ";
            $entries = getDBEntryCount($statement);

            $statement .= setLimit($startAt, $rowsPerPage);
        
            echo "Name beinhaltet \"" . $input1 . "\"";
        } else {
            $statement = filterNone();

            $statement .= " GROUP BY id ";
            $entries = getDBEntryCount($statement);

            $statement .= setLimit($startAt, $rowsPerPage);
            echo "Kein Filter gesetzt";
        }
    }
} else {
    $statement = filterNone();
    
    $statement .= " GROUP BY id ";
    $entries = getDBEntryCount($statement);
    
    $statement .= setLimit($startAt, $rowsPerPage);
    echo "Kein Filter gesetzt";
}