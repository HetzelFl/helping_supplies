<?php

global $country;
global $abbreviation;
global $startCountry;
global $startVillage; 
global $destCountry; 
global $destVillage; 
global $startDate; 
global $endDate;
global $product;
global $productAdd;

global $countryErr;

//PRODUCTS-----------------------------------------------
function selectProductDropbox(){
   
    try{
        global $db;
        
        $statement = "Select productname from products";

        foreach ( $db->query($statement) as $row){

            echo "<option value=$row[productname]>$row[productname]</option>\n";
        }

    } catch (Exception $ex) {

    }
}

function deleteProduct($value){
        try{
        global $db;
        
        $statement = "DELETE FROM products WHERE productname = ?";

        if($db->prepare($statement)->execute(array($value)))
            return "ALL OK";
        else
            return "NOT OK";


    } catch (Exception $ex) {
        echo "ERROR: " .$ex;
    }
    
}

function addProduct($value){
        try{
        global $db;
        
        $statement = "INSERT INTO products (productname) VALUES (?)";

        if($db->prepare($statement)->execute(array($value)))
            return "ALL OK";
        else
            return "NOT OK";
    } catch (Exception $ex) {
        echo "ERROR: " .$ex;
    }  
}

//COUNTRIES-----------------------------------------------
function deleteCountry($value){
        try{
        global $db;
        
        $statement = "DELETE FROM countries WHERE countryName = ?";

        if($db->prepare($statement)->execute(array($value)))
            return "ALL OK";
        else
            return "NOT OK";
    } catch (Exception $ex) {
        echo "ERROR: " .$ex;
    }
}

function addCountry($abbreviation, $name){
        try{
        global $db;
        
        $statement = "INSERT INTO countries (abbreviation, countryName) VALUES (?,?)";

        if($db->prepare($statement)->execute(array($abbreviation, $name)))
            return "ALL OK";
        else
            return "NOT OK";
    } catch (Exception $ex) {
        echo "ERROR: " .$ex;
    }  
}

function getAllDeliverer(){
    
    return "SELECT do.id, do.offerer, c1.countryName as startCountry, do.startVillage, c2.countryName as destCountry, do.destinationVillage, do.startDate, prod.pr "
                          . "FROM "
                          . "(SELECT p.productname as pr, d.ID "
                          . "FROM productsdelivererjoin pdj "
                          . "join products p on pdj.ID_product = p.ID "
                          . "join deliverer_offer d on pdj.ID_delivererOffer = d.ID) prod, deliverer_offer do "
                          . "join countries c1 on do.startCountry = c1.id "
                          . "join countries c2 on do.destinationCountry = c2.ID "
                          . "WHERE prod.ID = do.ID ORDER BY do.ID";
}

function getAllOrga(){
    
    return "SELECT oo.id, oo.offerer, c1.countryName as startCountry, oo.startVillage, c2.countryName as destCountry, oo.destinationVillage, oo.startDate, prod.pr "
                          . "FROM "
                          . "(SELECT p.productname as pr, o.ID "
                          . "FROM productsorgajoin poj "
                          . "join products p on poj.ID_product = p.ID "
                          . "join organisation_offer o on poj.ID_organisationOffer = o.ID) prod, organisation_offer oo "
                          . "join countries c1 on oo.startCountry = c1.id "
                          . "join countries c2 on oo.destinationCountry = c2.ID "
                          . "WHERE prod.ID = oo.ID ORDER BY oo.ID" ;
}

function deleteOrgaOffer($offerID){
    
    global $db;

    $statement = "DELETE FROM organisation_offer WHERE id = ?";

    if ($db->prepare($statement)->execute(array($offerID)))
        return "ALL OK";
    else
        return "NOT OK";
}

function deleteDeliverOffer($offerID){
    
    global $db;

    $statement = "DELETE FROM deliverer_offer WHERE id = ?";

    if ($db->prepare($statement)->execute(array($offerID)))
        return "ALL OK";
    else
        return "NOT OK";
}