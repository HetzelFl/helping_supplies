<?php

$table = 'organisation_offer';
//$id = $_POST['offerID'];
$id = $_SESSION['accountsId'];

include '../includes/functions.php';
include './Angebot_erstellen.php';
include './Offer_HTML_functions.php';
include './eingabeCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if($postOK){
        try{
        create_Offer($table, $name, $contact, $eMail, $startCountry, $startVillage, $destCountry, $destVillage, reformDate($startDate), reformDate($endDate), $products, $id);
        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
        header('Location: leere.php');
        }
        catch(Exception $e){
            
            echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
        }
    }
}

include './create_Offer_allg_HTML.php';
?>
