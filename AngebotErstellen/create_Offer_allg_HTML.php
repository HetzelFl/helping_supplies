<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include_once ($root . "/PAUL/Template/template/head.php");
include_once ($root . "/PAUL/Template/template/header.php");

include './Angebot_erstellen.php';
include './Offer_HTML_functions.php';
include './eingabeCheck.php';

$id = 1;



?>
<div class="container">
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <p></p>
            <?php
            if($table == 'deliverer_offer'){
                echo "<h2>Privatpersonen Angebote</h2>";
            }
            else{
               echo "<h2>Organisation Angebote</h2>"; 
            }
            ?>
            <div class="columns five">
            <?php 
            if($table == 'deliverer_offer'){
                
                echo "Ihr Name*: <p><input type=\"text\" name=\"name\" value=\"$name\" required=\"required\">" .
                "<span class=\"error\"> $nameErr</span>" .
                "</p>";
            }
            else{
                
              echo "Ihre Organisation*: <p><input type=\"text\" name=\"name\" value=\"$name\" required=\"required\">" .
                "<span class=\"error\"> $nameErr</span>" .
                "</p>";
              echo "Ansprechpartner: <p><input type=\"text\" name=\"contact\" value=\"$contact\"> " .
                "<span class=\"error\"> $contactErr</span>" .
                "</p>";
            }
            ?>
                Ihre eMail*: 
                <p><input type="email" name="eMail" value="<?php
                                if(!isset($_POST['eMail']))
                                    echo getAccountColumnData($id, 'eMail');
                                else
                                    echo $eMail;
                                ?>" required="required"/>
                <span class="error"> <?php echo $eMailErr;?></span>
                </p>
            </div>
            
            <div class="columns five">
            Das Startland*: 
            
            <p><select name="startCountry" required="required">
                    <option value="<?php echo $startCountry; ?>"><?php echo $startCountry; ?></option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $startCErr;?></span>
            </p>  

            Das Startdorf*: 
            <p><input type="text" name="startVillage" value="<?php echo $startVillage; ?>" required="required"/>
                <span class="error"> <?php echo $startVErr;?></span>
            </p>
            </div>
            
            <div class="columns five">
            Das Zielland*:  
            
                <p><select name="destCountry" required="required">
                    <option value="<?php echo $destCountry; ?>"><?php echo $destCountry; ?></option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $destCErr;?></span>
                </p>

            Das Zieldorf*: 
                <p><input type="text" name="destVillage" value="<?php echo $destVillage; ?>" required="required"/>
                <span class="error"> <?php echo $destVErr;?></span>
                </p>
            </div>
            
            <div class="columns five">
            Das Startdatum*: 
            <p><input type="date" name="startDate" value="<?php echo $startDate; ?>" required="required"/>
                <span class="error"> <?php echo $startDateErr;?></span>
            </p>

            Das Enddatum*: 
            <p><input type="date" name="endDate" value="<?php echo $endDate; ?>" required="required"/>
                <span class="error"> <?php echo $endDateErr;?></span>
            </p>
            </div>
            <div class="columns five">
            Welches Produkt: 
                <p>   
                    <?php      
                        checkBoxProducts();
                    ?>
                <span class="error"> <?php echo $productErr;?></span>
                </p>
                <input type="submit" />
            </div>
            
        </form>
</div>
<?php
// include footer
include_once ($root . "/PAUL/Template/template/footer.php");

?>
    
