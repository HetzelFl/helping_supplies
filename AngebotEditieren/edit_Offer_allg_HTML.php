<?php

$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include_once ($root . "/PAUL/Template/template/head.php");
include_once ($root . "/PAUL/Template/template/header.php");   
?>    
<div class="container">
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <p></p>
            <div class="columns five">
            <?php
            if($table == 'organisation_offer'){
            echo "Ihr Organame: <p><input type=\"text\" name=\"name\" value=\"";
                                
                if(!isset($_POST['name']))
                    echo getColumnData($id, 'name')."\">";
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
                echo "Ihr Name: <p><input type=\"text\" name=\"name\" value=\"";
                                
                if(!isset($_POST['name']))
                    echo getColumnData($id, 'name')."\">";
                else
                    echo $name."\">";
                
                echo "<span class=\"error\">$nameErr</span>";
            echo "</p>";
            }
            ?>
            
            Ihre eMail: 
            <p><input type="email" name="eMail" value=
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
            
                <p><select name="startCountry">
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
            
            Das Startdorf: 
            <p><input type="text" name="startVillage" value=
                <?php
                if(!isset($_POST['startVillage']))
                    echo getColumnData($id, 'startVillage');
                else
                    echo $startVillage;
                ?>>
                <span class="error"> <?php echo $startVErr;?></span>
            </p>
            </div>
            
            <div class="columns five">
            Das Zielland:  
            
                <p><select name="destCountry">
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
                        
            Das Zieldorf: 
            <p><input type="text" name="destVillage" value=
                <?php
                if(!isset($_POST['destVillage']))
                    echo getColumnData($id, 'destinationVillage');
                else
                    echo $destVillage;
                ?>>
                <span class="error"> <?php echo $destVErr;?></span>
            </p>
            </div>
            
            <div class="columns five">
            Das Startdatum: 
            <p><input type="date" name="startDate" value=
                <?php
                if(!isset($_POST['startDate']))
                    echo reformDatetoNormal(getColumnData($id, 'startDate'));
                else
                    echo $startDate;
                ?>>
                <span class="error"> <?php echo $startDateErr;?></span>
            </p>
            
            Das Enddatum: 
            <p><input type="date" name="endDate" value=
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
            <p>        
                    <?php      
                        checkBoxProductsFilled($id);
                    ?>
            
                <span class="error"> <?php echo $productErr;?></span>
                <p>
            <input type="submit" />
            </div>
        </form>
</div>
<?php
// include footer
include_once ($root . "/PAUL/Template/template/footer.php");

?>

