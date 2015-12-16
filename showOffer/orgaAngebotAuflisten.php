<?php

$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include_once ($root . "/PAUL/Template/template/head.php");
include_once ($root . "/PAUL/Template/template/header.php");
include './AngebotEditieren/Edit_HTML_functions.php';
include './filterOrgalistFunction.php';
include './dbConnect.php';
?>
        <table style="width: 100%">
            <tr align="left">
                          <th>Angebots-ID</th>
                          <th>Name</th>
                          <th>Startland</th>
                          <th>Startdorf</th>
                          <th>Zielland</th>
                          <th>Zieldorf</th>
                          <th>Startdatum</th>
                          <th>Produkt</th>
                          <th>Kontakt</th>
            </tr>
            <?php
                  $statement = filterNone();
                  //$statement = filterStartCountry("Deutschland");
                   $id = -1;
                   $counter = 0;
                   
                  $test=$db->query($statement);
                  $test->fetch();
                  foreach($iter=$db->query($statement) as $row)
                  /*while($row = mysql_fetch_array($result))*/
                  {   //Creates a loop to loop through results                       
                      if($id != htmlspecialchars($row['id'])){
                          $id = htmlspecialchars($row['id']);
                          echo "<tr align=\"left\">\n";
                          echo "<td>" . htmlspecialchars($row['id']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['name']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['startCountry']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['startVillage']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['destCountry']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['destinationVillage']) . "</td>\n";
                          echo "<td>" . reformDatetoNormal(htmlspecialchars($row['startDate'])) . "</td>\n";
                          echo "<td>";
                          
                          do{
                            echo htmlspecialchars($row['pr']);
                            
                            if(($temp = $test->fetchColumn()) == $id){
                                $row = $iter->fetch();
                                echo ", ";
                            }
                            else {
                                break;
                            }
                                                  
                          }while(true);
                          echo "</td>\n";
                          echo "<td>" . "<a href=\"mailto.html/mail?\">kontaktieren </a></td>\n";
                          echo "</tr>";  //$row['index'] the index here is a field name
                      }
                  }
            ?>
        </table>

<?php
// include footer
include_once ($root . "/PAUL/Template/template/footer.php");

?>