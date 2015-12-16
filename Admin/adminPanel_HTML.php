<?php

$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include_once ($root . "/PAUL/Template/template/head.php");

include '../dbConnect.php';
include './adminPanelFunctions.php';

?>
<p></p>
<div class="container">
        <!-- DELETE COUNTRY -->
        <div class="columns five">
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    
            <h3>Land entfernen</h3>
            
            <label>Länder:</label> 
            
            <p> <select name="startCountry" >
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
            </p>
            <input type="submit" value="Löschen">
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["startCountry"])){
                
                $startCountry = test_input($_POST["startCountry"]);
                
                if( $_POST["startCountry"] != ""){
                    try{
                        echo "Test";
                        //create_Offer($table, $name, $contact, $eMail, $startCountry, $startVillage, $destCountry, $destVillage, reformDate($startDate), reformDate($endDate), $products);
                        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                        //header('Location: leere.php');

                    }
                    catch(Exception $e){
                        echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                    }
                }
            }
            ?>
        </form>
        
        <!-- ADD NEW COUNTRY -->
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            
            <h3>Land hinzufügen</h3>

                <p>
                    <label>Länderabkürzung: </label>
                    <input type="text" name="abbreviation" value="<?php if(isset($_POST["abbreviation"])) echo $_POST["abbreviation"]; ?>" required="required" />
                </p>
                <p>
                    <label>Ländername: </label>
                    <input type="text" name="country" value="<?php if(isset($_POST["country"])) echo $_POST["country"]; ?>" required="required" />
                    
                </p>
            <input type="submit" value="Hinzufügen">
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["country"]) && isset($_POST["abbreviation"])){
                
                //global $country, $abbreviation;
                $country = test_input($_POST["country"]);
                $abbreviation = test_input($_POST["abbreviation"]);
                
                if (preg_match("/^[a-zA-Z ]*$/",$abbreviation) && preg_match("/^[a-zA-Z ]*$/",$country)){
                    if( $_POST["country"] != "" && $_POST["abbreviation"] != "" ){
                        try{
                            echo "Test";
                            //create_Offer($table, $name, $contact, $eMail, $startCountry, $startVillage, $destCountry, $destVillage, reformDate($startDate), reformDate($endDate), $products);
                            //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                            header('Location: leere.php');

                        }
                        catch(Exception $e){
                            echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                        }
                    }
                }
                else{
                    echo $countryErr;
                    $countryErr = "Bitte nur Buchstaben und Leerzeichen verwenden.";
                }
            }
            ?>
        </form>
        </div>
        
        <!-- DELETE PRODUCT -->
        <div class="columns five">
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            
            <h3>Produkt entfernen</h3>
            <label>Produkte:</label> 
            
            <p> <select name="product" >
                
                    <?php
                        selectProductDropbox();
                   ?> 
                </select> 
            </p> 
            
            <input type="submit" value="Löschen">
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product"])){
                
                $product = test_input($_POST["product"]);
                
                if( $_POST["product"] != ""){
                    try{
                        echo (deleteProduct($product));
                        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                        //header('Location: leere.php');

                    }
                    catch(Exception $e){
                        echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                    }
                }
                else
                    echo "TEST";
            }
            ?>
        </form>
        
        <!-- ADD PRODUCT -->
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            
            <h3>Produkt hinzufügen</h3>
            
            <label>Produkte:</label> 
                <p><input type="text" name="productAdd"> </p>
            
            <input type="submit" value="Hinzufügen">
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productAdd"])){
                
                $productAdd = test_input($_POST["productAdd"]);
                
                if( $_POST["productAdd"] != ""){
                    try{
                        echo (addProduct($productAdd));
                        //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                        //header('Location: leere.php');

                    }
                    catch(Exception $e){
                        echo "Fehler beim Datenbankzugriff. Bitte dem Administrator Bescheid geben.";
                    }
                }
                else
                    echo "TEST";
            }
            ?>
        </form>
        </div>
</div>
    </body>
</html>