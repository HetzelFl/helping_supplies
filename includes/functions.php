<?php

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

function reformDatetoNormal($date){
    return (new DateTime($date))->format('d.m.Y');
}

function orgaDeactivate($id){
    
    global $db;
    
    $statement = "UPDATE organisation_offer "
            . "SET startDate = '0000-00-00', endDate = '0000-00-00' "
            . "WHERE id = $id";
    
    $db->query($statement);
    
    
}

function deliverDeactivate($id){
    
    global $db;
    
    $statement = "UPDATE deliverer_offer "
            . "SET startDate = '0000-00-00', endDate = '0000-00-00' "
            . "WHERE id = $id";
    
    $db->query($statement);
    
    
}
?>
