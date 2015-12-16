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

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

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
function selectCountryDropbox(){

    try{
        global $db;
        
        $statementStartC = "Select countryname from countries";

        foreach ( $db->query($statementStartC) as $row){

            echo "<option value=$row[countryname]>$row[countryname]</option>\n";
        }
    } catch (Exception $ex) {

    }
}

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