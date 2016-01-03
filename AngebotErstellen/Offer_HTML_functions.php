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
global $text;
$contact = NULL;
global $eMail;
global $startCountry;
global $startVillage; 
global $destCountry; 
global $destVillage; 
global $startDate; 
global $endDate;
global $products;

function checkBoxProducts(){
    
    global $db;
    
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
             
             echo "> $row[productname]</p>\n";
     }

    } catch (Exception $ex) {

    }
    
}

function getAccountColumnData($id, $column){
    
    global $db;
    
    $statement = $db->prepare("SELECT $column FROM accounts WHERE ID = ? ");
    
    $statement->execute(array($id));
    //foreach ($db->query($statement) as $row){
        $result = $statement->fetchColumn();
        return $result;
    //}
}