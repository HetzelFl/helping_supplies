<?php

include '../includes/dbConnectPDO.php';
    
function edit_Offer( $table, $id, $name, $contact, $eMail, $startCountry, $startVillage,
                        $destinationCountry, $destinationVillage, $startDate, $endDate, $products, $text)
{
    global $db, $cID, $cName, $cContact, $ceMail, $cStartC, $cstartV, $cdestC, $cdestV, $cdateStart, $cdateEnd, $crespAcc, $cText;
    
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

    
    try{
        $statement00 = $db->prepare("SELECT ID FROM $tableCountry WHERE countryName LIKE '$startCountry'");
        $statement00->execute();
        $startCountry1 = $statement00->fetchColumn();
        
        $statement01 = $db->prepare("SELECT ID FROM $tableCountry WHERE countryName LIKE '$destinationCountry'");
        $statement01->execute();
        $destinationCountry1 = $statement01->fetchColumn();
        
        if($tableOffer == 'organisation_offer'){
            $statement1 = $db->prepare("UPDATE $tableOffer "
                . "                 SET $cName=?, $cContact=?, $ceMail=?, $cStartC=?, $cstartV=?, $cdestC=?, $cdestV=?, $cdateStart=?, $cdateEnd=?, $cText=? "
                    . "WHERE $cID=?");
            $statement1->execute(array($name, $contact, $eMail, $startCountry1, $startVillage,
                            $destinationCountry1, $destinationVillage, $startDate, $endDate, $text, $id ));
        }
        else{
            $statement1 = $db->prepare("UPDATE $tableOffer "
                . "                 SET $cName=?, $ceMail=?, $cStartC=?, $cstartV=?, $cdestC=?, $cdestV=?, $cdateStart=?, $cdateEnd=?, $cText=? "
                    . "WHERE $cID=?");
            $statement1->execute(array($name, $eMail, $startCountry1, $startVillage,
                            $destinationCountry1, $destinationVillage, $startDate, $endDate, $text, $id ));
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