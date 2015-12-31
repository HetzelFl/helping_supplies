<?php

global $nameErr;
global $contactErr;
global $eMailErr;
global $startCErr;
global $startVErr;
global $destCErr;
global $destVErr;
global $startDateErr;
global $endDateErr;
global $productErr;
global $name; 
global $contact;
$contact = NULL;
global $eMail;
global $startCountry;
global $startVillage; 
global $destCountry; 
global $destVillage; 
global $startDate; 
global $endDate;
global $products;

function checkBoxProductsFilled($offer_id){
    
    global $db;
    global $noSubmit;
    global $table;
    if($noSubmit){
        $noSubmit = false;
        try{
        
            $statementProd = "Select * from products";

            if($table == 'organisation_offer')
                $statementJoin = "SELECT * FROM productsorgajoin WHERE ID_organisationOffer = $offer_id";
            else
                $statementJoin = "SELECT * FROM productsdelivererjoin WHERE ID_delivererOffer = $offer_id";
     
            foreach ( $db->query($statementProd) as $row1){

                $checked = FALSE;

                foreach( $db->query($statementJoin) as $row2){
                    if($row1['ID'] === $row2['ID_product'])
                        $checked = True; 
                }
                if($checked)
                    echo "<p><input type=\"checkbox\" name=\"productChoice[]\" value=$row1[productname] id=\"check1\" checked=\"checked\"> $row1[productname]</p>\n";
                else
                    echo "<p><input type=\"checkbox\" name=\"productChoice[]\" value=$row1[productname] id=\"check1\"> $row1[productname]</p>\n";
            }

       } catch (Exception $ex) {
       }
    }
    else{
        try{
            $statementProd = "Select productname from products";

            foreach ( $db->query($statementProd) as $row){
  
                echo "<p><input type=\"checkbox\" name=\"productChoice[]\" value=$row[productname] id=$row[productname] ";
                if(isset($_POST["productChoice"]) && in_array($row["productname"], $_POST["productChoice"])){
                    echo "checked=\"checked\" ";
                }
                else{ 
                    echo "";
                }
             
                echo ">$row[productname]</p>\n";
            }
        } catch (Exception $ex) {
        }
    }
    
}

function getCountry($id){
    
    global $db;
    
    try{
     $statementProd = "Select countryName from countries "
             . "WHERE id = $id ";

     foreach ( $db->query($statementProd) as $row){

         return $row['countryName'];
      
     }

    } catch (Exception $ex) {
        
        echo "ERROR";

    }  
}

function getColumnData($id, $column){
    
    global $db;
    global $table;
    
    $statement = "SELECT $column FROM $table WHERE id = $id";
    
    foreach ($db->query($statement) as $row){
        
        return $row[$column];
    }
}

function validateDate($date, $format = 'd.m.Y')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function reformDatetoDB($date){
    
    return (new DateTime($date))->format('Y-m-d');
}

function reformDatetoNormal($date){
    return (new DateTime($date))->format('d.m.Y');
}

//function must be placed between <select><\select>
function selectCountryDropbox(){

    try{
        global $db;
        
        $statementStartC = "Select countryname from countries";

        foreach ( $db->query($statementStartC) as $row){

            echo "<option chevalue=$row[countryname]>$row[countryname]</option>\n";
        }

        } catch (Exception $ex) {
        }
}

function getOwnDeliverer($accID){
    
    return "SELECT do.id, do.name, c1.countryName as startCountry, do.startVillage, c2.countryName as destCountry, do.destinationVillage, do.startDate, prod.pr "
                          . "FROM "
                          . "(SELECT p.productname as pr, d.ID "
                          . "FROM productsdelivererjoin pdj "
                          . "join products p on pdj.ID_product = p.ID "
                          . "join deliverer_offer d on pdj.ID_delivererOffer = d.ID) prod, deliverer_offer do "
                          . "join countries c1 on do.startCountry = c1.id "
                          . "join countries c2 on do.destinationCountry = c2.ID "
                          . "WHERE prod.ID = do.ID AND do.responsibleAcc = $accID";
}

function getOwnOrga($accID){
    
    return "SELECT oo.id, oo.name, c1.countryName as startCountry, oo.startVillage, c2.countryName as destCountry, oo.destinationVillage, oo.startDate, prod.pr "
                          . "FROM "
                          . "(SELECT p.productname as pr, o.ID "
                          . "FROM productsorgajoin poj "
                          . "join products p on poj.ID_product = p.ID "
                          . "join organisation_offer o on poj.ID_organisationOffer = o.ID) prod, organisation_offer oo "
                          . "join countries c1 on oo.startCountry = c1.id "
                          . "join countries c2 on oo.destinationCountry = c2.ID "
                          . "WHERE prod.ID = oo.ID AND oo.responsibleAcc = $accID";;
}