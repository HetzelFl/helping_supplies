<?php

$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include_once ($root . "/helping_supplies/template/head.php");
include_once ($root . "/helping_supplies/template/header.php");

$accountID = $_SESSION['accountsId'];

if(getColumnData($id, 'responsibleAcc') != $accountID){
    header("Location: /helping_supplies/index.php");
    exit;
}
?>    
<div class="container">
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <p></p>
            <?php
            if($table == 'deliverer_offer'){
                echo "<h2>Liferer Angebote</h2>";
            }
            else{
               echo "<h2>Bereitsteller Angebote</h2>"; 
            }
            ?>
            <div class="columns five">
            <?php
            if($table == 'organisation_offer'){
            echo "Ihr Organame: <p><input type=\"text\" name=\"name\" required=\"required\" value=\"";
                                
                if(!isset($_POST['name']))
                    echo getColumnData($id, 'offerer')."\">";
                else
                    echo $name."\">";
                
                echo "<span class=\"error\">$nameErr</span>";
            echo "</p>";
            
            echo "Ansprechpartner: <p><input type=\"text\" name=\"contact\" value=\"";
                if(!isset($_POST['contact']))
                    echo getColumnData($id, 'contact')."\">";
                else
                    echo $contact."\">";
                    
                echo "<span class=\"error\">$contactErr</span>";
            echo "</p>";
            }
            else{
                echo "Ihr Name: <p><input type=\"text\" name=\"name\" required=\"required\" value=\"";
                                
                if(!isset($_POST['name']))
                    echo getColumnData($id, 'offerer')."\">";
                else
                    echo $name."\">";
                
                echo "<span class=\"error\">$nameErr</span>";
            echo "</p>";
            }
            ?>
            
            Ihre eMail: 
            <p><input type="email" name="eMail" required="required" required="required" value=
                                <?php
                                if(!isset($_POST['eMail']))
                                    echo getColumnData($id, 'eMail');
                                else
                                    echo $eMail;
                                ?>>
                <span class="error"> <?php echo $eMailErr;?></span>
            </p>
            </div>
            
            <div class="columns five">
            Das Startland: 
            
                <p><select name="startCountry" required="required" >
                    <option value=
                        <?php
                        if(!isset($_POST['startCountry']))
                            echo getCountry(getColumnData($id, 'startCountry'));
                        else
                            echo $startCountry;
                        ?>
                    >
                    <?php
                    if(!isset($_POST['startCountry']))
                        echo getCountry(getColumnData($id, 'startCountry'));
                    else
                        echo $startCountry;
                    ?>
                    </option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $startCErr;?></span>
            </p>  
            
            Der Startort: 
            <p><input type="text" name="startVillage" required="required" value=
                <?php
                if(!isset($_POST['startVillage']))
                    echo "\"" . getColumnData($id, 'startVillage'). "\"";
                else
                    echo "\"" . $startVillage . "\"";
                ?>>
                <span class="error"> <?php echo $startVErr;?></span>
            </p>

            Das Zielland:  
            
                <p><select name="destCountry" required="required" >
                    <option value=
                        <?php
                        if(!isset($_POST['destCountry']))
                            echo getCountry(getColumnData($id, 'destinationCountry'));
                        else
                            echo $destCountry;
                        ?>
                    >
                        <?php
                        if(!isset($_POST['destCountry']))
                            echo getCountry(getColumnData($id, 'destinationCountry'));
                        else
                            echo $destCountry;
                        ?>
                    </option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $destCErr;?></span>
            </p>
                        
            Der Zielort: 
            <p><input type="text" name="destVillage" required="required" value=
                <?php
                if(!isset($_POST['destVillage']))
                    echo "\"" . getColumnData($id, 'destinationVillage') . "\"";
                else
                    echo "\"" . $destVillage . "\"";
                ?>>
                <span class="error"> <?php echo $destVErr;?></span>
            </p>
            </div>
            
            <div class="columns five">
            Das Startdatum: 
            <p><input type="date" name="startDate" required="required" value=
                <?php
                if(!isset($_POST['startDate']))
                    echo reformDatetoNormal(getColumnData($id, 'startDate'));
                else
                    echo $startDate;
                ?>>
                <span class="error"> <?php echo $startDateErr;?></span>
            </p>
            
            Das Enddatum: 
            <p><input type="date" name="endDate" required="required" value=
                <?php
                if(!isset($_POST['endDate']))
                    echo reformDatetoNormal(getColumnData($id, 'endDate'));
                else
                    echo $endDate;
                ?>>
                <span class="error"> <?php echo $endDateErr;?></span>
            </p>
            </div>
            
            <div class="columns five">
            Welches Produkt: 
                    
                    <?php      
                        checkBoxProductsFilled($id);
                    ?>
            
                <p><span class="error"> <?php echo $productErr;?></span></p>
                
            
            </div>
            <div class="columns five">
                <textarea maxlength="3500" class="u-full-width" placeholder="Sonstige wichtige Information..." 
                          id="exampleMessage" name="text"><?php if(!isset($_POST['textField']))
                                                                    echo getColumnData($id, 'textField');
                                                                else echo $text?></textarea>
                <?php echo "<input type=\"hidden\" name=\"id\" value=$id />"; ?>
                <input type="submit" />
            </div>
        </form>
</div>
<?php
// include footer
include_once ($root . "/helping_supplies/template/footer.php");

?>

