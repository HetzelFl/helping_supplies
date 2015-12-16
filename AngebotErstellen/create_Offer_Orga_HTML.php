<?php
$table = 'organisation_offer';
//$id = $_POST['offerID'];
$id = 1;
include './create_Offer_allg_HTML.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if($postOK){
        try{
        create_Offer($table, $name, $contact, $eMail, $startCountry, $startVillage, $destCountry, $destVillage, reformDate($startDate), reformDate($endDate), $products);
        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
        header('Location: leere.php');

        }
        catch(Exception $e){
            echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
        }
    }
}
?>
