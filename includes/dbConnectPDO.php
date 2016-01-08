<?php

$db = new PDO('mysql:host=localhost;
       dbname=PAUL;
       charset=utf8', 'root', '', 
       array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

   //Colums for the table deliverer/organisation_offer:
    $cID = 'ID';
    $cName = 'offerer';
    $cContact = 'contact';
    $ceMail = 'eMail';
    $cStartC = 'startCountry';
    $cstartV = 'startVillage';
    $cdestC = 'destinationCountry';
    $cdestV = 'destinationVillage';
    $cdateStart = 'startDate';
    $cdateEnd = 'endDate';
    $crespAcc = 'responsibleAcc';
    $cText = 'textField';