<?php

$sqlStatement = "SELECT oo.id, oo.offerer, c1.countryName as startCountry, oo.startVillage, c2.countryName as destCountry, oo.destinationVillage, oo.startDate, prod.pr "
                          . "FROM "
                          . "(SELECT p.productname as pr, o.ID "
                          . "FROM productsorgajoin poj "
                          . "join products p on poj.ID_product = p.ID "
                          . "join organisation_offer o on poj.ID_organisationOffer = o.ID) prod, organisation_offer oo "
                          . "join countries c1 on oo.startCountry = c1.id "
                          . "join countries c2 on oo.destinationCountry = c2.ID "
                          . "WHERE prod.ID = oo.ID "
                          . "AND startDate >= Curdate() ";

function filterNone(){
    
    global  $sqlStatement;
    
    return $sqlStatement;
}

function filterStartCountry($startCountry){
    
    global  $sqlStatement;
    
    return $sqlStatement . "AND startCountry = (Select ID FROM countries where countryName = '$startCountry')";
}

function filterDestCountry($destCountry){
    
    global  $sqlStatement;
    
    return $sqlStatement. "AND destinationCountry = (Select ID FROM countries where countryName = '$destCountry')";
}

function filterDatespan($lowerDate, $upperDate){
    
    global  $sqlStatement;
    
    return $sqlStatement. "AND startDate >= \"$lowerDate\" AND endDate <= \"$upperDate\"";
}

function filterName($value){
    
    global  $sqlStatement;
    
    return $sqlStatement. "AND offerer LIKE \"%$value%\"";
}


