<?php

include '../includes/dbConnectPDO.php';

function create_Offer( $table, $name, $contact, $eMail, $startCountry, $startVillage,
                        $destinationCountry, $destinationVillage, $startDate, $endDate, $products, $accountID, $text)
{
    global $db, $cName, $cContact, $ceMail, $cStartC, $cstartV, $cdestC, $cdestV, $cdateStart, $cdateEnd, $crespAcc, $cText;
    
    $tableName1 = $table;
    if($tableName1 == 'organisation_offer'){
        $tableName2 = 'productsorgajoin';
    }
    else{
        $tableName2 = 'productsdelivererjoin';
    }
    $tableName3 = 'countries';
    //Colums for the table organisation_offer:
    
    try{
        $statement00 = $db->prepare("SELECT ID FROM $tableName3 WHERE countryName LIKE '$startCountry'");
        $statement00->execute();
        $startCountry1 = $statement00->fetchColumn();
        
        $statement01 = $db->prepare("SELECT ID FROM $tableName3 WHERE countryName LIKE '$destinationCountry'");
        $statement01->execute();
        $destinationCountry1 = $statement01->fetchColumn();
        
        if($tableName1 == 'organisation_offer'){
            $statement1 = $db->prepare("INSERT INTO $tableName1 "
                . "                 ($cName, $cContact, $ceMail, $cStartC, $cstartV, $cdestC, $cdestV, $cdateStart, $cdateEnd, $crespAcc, $cText) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
            $statement1->execute(array($name, $contact, $eMail, $startCountry1, $startVillage,
                            $destinationCountry1, $destinationVillage, $startDate, $endDate, $accountID, $text ));
        }
        else{
            $statement1 = $db->prepare("INSERT INTO $tableName1 "
                . "                 ($cName, $ceMail, $cStartC, $cstartV, $cdestC, $cdestV, $cdateStart, $cdateEnd, $crespAcc, $cText) VALUES(?,?,?,?,?,?,?,?,?,?)");
            $statement1->execute(array($name, $eMail, $startCountry1, $startVillage,
                            $destinationCountry1, $destinationVillage, $startDate, $endDate, $accountID, $text ));
        }
        $lastInsertID = $db->lastInsertId();

        foreach ($products as $p){
            
            $statement2 = $db->prepare("INSERT INTO $tableName2 values( (SELECT products.ID FROM products WHERE products.productname LIKE '$p'), ?)");
            $statement2->execute(array($lastInsertID));
        }
    }
    catch(Exception $e){
        
        echo "Fehler beim Datenbankzugriff. Kontaktieren Sie den Administrator." . $e;        
    }
}