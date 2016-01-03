<?php

if(isset($_GET["id"]))
    $id = $_GET["id"];
$table = 'deliverer_offer';
$noSubmit= true; //needed for checked boxes at products

include '../includes/functions.php';
include './Angebot_editieren.php';
include './Edit_HTML_functions.php';
include '../AngebotErstellen/eingabeCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $id = $_POST["id"];
    $noSubmit= FALSE;
    if($postOK){
        try{
        edit_Offer($table, $id, $name, $contact, $eMail, $startCountry, $startVillage, $destCountry, $destVillage, reformDatetoDB($startDate), reformDatetoDB($endDate), $products, $text);
        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
        header('Location: leere.php');

        }
        catch(Exception $e){
            echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
        }
    }
}

include './edit_Offer_allg_HTML.php';


?>




