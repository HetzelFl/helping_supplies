<?php

$sqlStatement = "SELECT do.id, do.offerer, c1.countryName as startCountry, do.startVillage, c2.countryName as destCountry, do.destinationVillage, do.startDate, prod.pr "
                          . "FROM "
                          . "(SELECT p.productname as pr, d.ID "
                          . "FROM productsdelivererjoin pdj "
                          . "join products p on pdj.ID_product = p.ID "
                          . "join deliverer_offer d on pdj.ID_delivererOffer = d.ID) prod, deliverer_offer do "
                          . "join countries c1 on do.startCountry = c1.id "
                          . "join countries c2 on do.destinationCountry = c2.ID "
                          . "WHERE prod.ID = do.ID "
                          . "AND endDate >= Curdate() ";

function filterNone(){
    
    global $sqlStatement;
    
    return $sqlStatement;
}

function filterStartCountry($startCountry){
    
    global $sqlStatement;
    
    return $sqlStatement . "AND startCountry = (Select ID FROM countries where countryName = '$startCountry')";
}

function filterDestCountry($destCountry){
    
    global $sqlStatement;
    
    return $sqlStatement . "AND destinationCountry = (Select ID FROM countries where countryName = '$destCountry')";
}

function filterDatespan($lowerDate, $upperDate){
    
    global $sqlStatement;
    
    return $sqlStatement . "AND startDate >= \"$lowerDate\" AND endDate <= \"$upperDate\"";
}

function filterName($value){
    
    global  $sqlStatement;
    
    return $sqlStatement. "AND offerer LIKE \"%$value%\"";
}

function setLimit($startAt, $rowPerPage){
    
    return " ORDER BY do.ID LIMIT $startAt, $rowPerPage";
    
}
