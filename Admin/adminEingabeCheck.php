<?php

$product;

        $postOK = true;
            
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                
                //STARTCOUNTRY---------------------------------
                if( $_POST["startCountry"] == ""){

                $startCErr = "Bitte Land auswählen oder eigenes Land eingeben"; 
                $postOK = false;    
                }

                $startCountry = test_input($_POST["startCountry"]);
/*
                //PRODUCTS---------------------------------
                if(empty($_POST["productChoice"])){
                    $productErr = "Bitte mind. ein Produkt auswählen"; 
                     $postOK = false;
                }
                else
                    $products = $_POST["productChoice"];
                  */              
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