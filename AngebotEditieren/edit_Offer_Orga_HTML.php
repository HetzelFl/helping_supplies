<?php

//$id = $_POST['offerID'];
$id = 1;
$table = 'organisation_offer';
$noSubmit= true;
include './Angebot_editieren.php';
include './Edit_HTML_functions.php';
include '../AngebotErstellen/eingabeCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $noSubmit = false;
    if($postOK){
        try{
        edit_Offer($table, $id, $name, $contact, $eMail, $startCountry, $startVillage, $destCountry, $destVillage, reformDatetoDB($startDate), reformDatetoDB($endDate), $products);
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




