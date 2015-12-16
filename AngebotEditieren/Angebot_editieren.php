<?php

include '../dbConnect.php';

function edit_Offer( $table, $id, $name, $contact, $eMail, $startCountry, $startVillage,
                        $destinationCountry, $destinationVillage, $startDate, $endDate, $products)
{
    global $db;
    
    $tableOffer = $table;
    if($tableOffer == 'organisation_offer'){
        $tableJoinOfferProd = 'productsorgajoin';
        $cJoinOfferID = 'ID_organisationOffer';
    }
    else{
        $tableJoinOfferProd = 'productsdelivererjoin';
        $cJoinOfferID = 'ID_delivererOffer';
    }
    $tableCountry = 'countries';
    //Colums for the table organisation_offer:
    $cID = 'ID';
    $cName = 'name';
    $cContact = 'contact';
    $ceMail = 'eMail';
    $cStartC = 'startCountry';
    $cstartV = 'startVillage';
    $cdestC = 'destinationCountry';
    $cdestV = 'destinationVillage';
    $cdateStart = 'startDate';
    $cdateEnd = 'endDate';
    $crespAcc = 'responsibleAcc';
    
    try{
        $statement00 = $db->prepare("SELECT ID FROM $tableCountry WHERE countryName LIKE '$startCountry'");
        $statement00->execute();
        $startCountry1 = $statement00->fetchColumn();
        
        $statement01 = $db->prepare("SELECT ID FROM $tableCountry WHERE countryName LIKE '$destinationCountry'");
        $statement01->execute();
        $destinationCountry1 = $statement01->fetchColumn();
        
        if($tableOffer == 'organisation_offer'){
            $statement1 = $db->prepare("UPDATE $tableOffer "
                . "                 SET $cName=?, $cContact=?, $ceMail=?, $cStartC=?, $cstartV=?, $cdestC=?, $cdestV=?, $cdateStart=?, $cdateEnd=? "
                    . "WHERE $cID=?");
            $statement1->execute(array($name, $contact, $eMail, $startCountry1, $startVillage,
                            $destinationCountry1, $destinationVillage, $startDate, $endDate, $id ));
        }
        else{
            $statement1 = $db->prepare("UPDATE $tableOffer "
                . "                 SET $cName=?, $ceMail=?, $cStartC=?, $cstartV=?, $cdestC=?, $cdestV=?, $cdateStart=?, $cdateEnd=? "
                    . "WHERE $cID=?");
            $statement1->execute(array($name, $eMail, $startCountry1, $startVillage,
                            $destinationCountry1, $destinationVillage, $startDate, $endDate, $id ));
        }

        $statement2 = $db->prepare("DELETE FROM $tableJoinOfferProd WHERE $cJoinOfferID = $id");
        $statement2->execute();
        foreach ($products as $p){
            $statement2 = $db->prepare("INSERT INTO $tableJoinOfferProd values( (SELECT products.ID FROM products WHERE products.productname LIKE '$p'), $id)");
            $statement2->execute();
        }
    }
    catch(Exception $e){
        
        echo "Fehler beim Datenbankzugriff. Kontaktieren Sie den Administrator.";        
    }
}