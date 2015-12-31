<?php

//include '../includes/functions.php';

        $postOK = true;
            
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                
                //ORGANAME---------------------------------
                if(empty($_POST["name"])){
                    $postOK = false;
                    $nameErr = "Bitte Namen eingeben";
                }
                else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) {
                    $postOK = false;
                    $nameErr = "Bitte nur Buchstaben und Leerzeichen eingeben";
                }
                $name = filterfunktion($_POST["name"]);
                
                //ANSPRECHPARTNER------------------------------
                if (isset($_POST["contact"])){
                    if(!preg_match("/^[a-zA-Z ]*$/",$_POST["contact"])) {
                        $postOK = false;
                        $contactErr = "Bitte nur Buchstaben und Leerzeichen eingeben";
                    }
                    $contact = filterfunktion($_POST["contact"]);
                }
                
                //eMAIL---------------------------------
                
                $eMail = filterfunktion($_POST["eMail"]);
                
                //STARTCOUNTRY---------------------------------
                if( $_POST["startCountry"] == ""){

                $startCErr = "Bitte Land auswählen"; 
                $postOK = false;    
                }

                $startCountry = filterfunktion($_POST["startCountry"]);
                
                
                //STARTVILLAGE---------------------------------
                if(empty($_POST["startVillage"])){
                   $startVErr = "Bitte Dorf eingeben"; 
                   $postOK = false; 
                }
                else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["startVillage"])) {
                        $startVErr = "Bitte nur Buchstaben und Leerzeichen eingeben";
                    }
                
                $startVillage = filterfunktion($_POST["startVillage"]);
                

                //DESTINATIONCOUNTRY---------------------------------
                if( $_POST["destCountry"] == ""){
                  $destCErr = "Bitte Land auswählen"; 
                  $postOK = false;
                }

                $destCountry = filterfunktion($_POST["destCountry"]);
                    
                //DESTINATIONVILLAGE---------------------------------
                if(empty($_POST["destVillage"])){
                   $destVErr = "Bitte Dorf eingeben"; 
                   $postOK = false;
                }
                else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["destVillage"])) {
                        $postOK = false;
                        $destVErr = "Bitte nur Buchstaben und Leerzeichen eingeben";
                }
                
                $destVillage = filterfunktion($_POST["destVillage"]);
                

                //STARTDATE---------------------------------
                if(empty($_POST["startDate"])){
                   $startDateErr = "Bitte Datum eingeben"; 
                   $postOK = false; 
                }
                else if(validateDate($_POST["startDate"])){
                    $startDate = (new DateTime($_POST["startDate"]))->format('d.m.Y');
                }
                else{
                    $startDateErr = "Bitte gültiges Datum eingeben (tt.mm.yyyy)";
                    $postOK = false;
                    $startDate = filterfunktion($_POST["startDate"]);
                }        

                //ENDDATE---------------------------------
                if(empty($_POST["endDate"])){
                     $endDateErr = "Bitte Datum eingeben"; 
                     $postOK = false;
                }
                else if(validateDate($_POST["endDate"])){
                    $endDate = (new DateTime($_POST["endDate"]))->format('d.m.Y');
                }
                else{
                    $endDateErr = "Bitte gültiges Datum eingeben (tt.mm.yyyy)";
                    $postOK = false;
                    $endDate = filterfunktion($_POST["endDate"]);
                }
                
                //DATECHECK--------------------------------
                
                if(strtotime(date('d.m.Y')) > strtotime(date($startDate))){
                    $startDateErr = "Datum muss heute oder in der Zukunft sein.";
                    $postOK = false;
                }
                else if(strtotime(date($endDate)) <= strtotime(date($startDate))){
                    $endDateErr = "Datum muss nach dem Startdatum sein";
                    $postOK = false;
                }

                //PRODUCTS---------------------------------
                if(empty($_POST["productChoice"])){
                    $productErr = "Bitte mind. ein Produkt auswählen"; 
                     $postOK = false;
                }
                else
                    $products = $_POST["productChoice"];
                                
                /*if($postOK){
                    try{
                    create_Offer($table, $name, $contact, $eMail, $startCountry, $startVillage, $destCountry, $destVillage, reformDate($startDate), reformDate($endDate), $products);
                    //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                    header('Location: leere.php');
                    
                    }
                    catch(Exception $e){
                        echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                    }
                    
                }*/
            }