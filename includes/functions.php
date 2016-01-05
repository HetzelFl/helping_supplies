<?php

function test(){
 echo "test";    
}

function filterfunktion($input){
    $input=strip_tags($input);
    $input=str_replace("\n", "", $input);
    $input=trim($input);
    return $input;
}

function zufallsstring($laenge) {
   //Mögliche Zeichen für den String
   $zeichen = '0123456789';
   $zeichen .= 'abcdefghijklmnopqrstuvwxyz';
   $zeichen .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $zeichen .= '()!.:=';
 
   //String wird generiert
   $str = '';
   $anz = strlen($zeichen);
   for ($i=0; $i<$laenge; $i++) {
      $str .= $zeichen[rand(0,$anz-1)];
   }
   return $str;
}

//use to check user input for validation -> format d.m.Y
function validateDate($date, $format = 'd.m.Y'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

//use to transform database dateformat Y-m-d to d.m.Y
function reformDatetoNormal($date){
    return (new DateTime($date))->format('d.m.Y');
}

//use to transform userinput date format d.m.Y to database format Y-m-d
function reformDatetoDB($date){ 
    return (new DateTime($date))->format('Y-m-d');
}

//function must be placed between <select></select>
//displays a dropbox with all countries
function selectCountryDropbox(){

    try{
        global $db;
        
        $statementStartC = "Select countryname from countries";

        foreach ( $db->query($statementStartC) as $row){

            echo "<option value='" .$row["countryname"]. "'>" .$row["countryname"]. "</option>\n";
        }

        } catch (Exception $ex) {

        }
}

function deliverDeactivate($id, $accountID){
    
    global $db;
    
    $statement = "UPDATE deliverer_offer "
            . "SET startDate = '1753-01-01', endDate = '1753-01-01' "
            . "WHERE id = ? AND responsibleAcc = ? ";
    
    $db->prepare($statement)->execute(array($id, $accountID));  
}

function orgaDeactivate($id, $accountID){
    
    global $db;
    
    $statement = "UPDATE organisation_offer "
            . "SET startDate = '1753-01-01', endDate = '1753-01-01' "
            . "WHERE id = ? AND responsibleAcc = ? ";
    
    $db->prepare($statement)->execute(array($id, $accountID));   
}

function getDBEntryCount($table){
    
    global $db;
    
    $statement = "Select count(*) cnt FROM ($table) test ";
    
    foreach($db->query($statement) as $row)
        return $row['cnt'];  
}
?>
