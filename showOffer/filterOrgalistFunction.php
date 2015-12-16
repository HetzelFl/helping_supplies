<?php

function filterNone(){
    
    return 'SELECT oo.id, oo.name, c1.countryName as startCountry, oo.startVillage, c2.countryName as destCountry, oo.destinationVillage, oo.startDate, prod.pr '
                          . 'FROM '
                          . '(SELECT p.productname as pr, o.ID '
                          . 'FROM productsorgajoin poj '
                          . 'join products p on poj.ID_product = p.ID '
                          . 'join organisation_offer o on poj.ID_organisationOffer = o.ID) prod, organisation_offer oo '
                          . 'join countries c1 on oo.startCountry = c1.id '
                          . 'join countries c2 on oo.destinationCountry = c2.ID '
                          . 'WHERE prod.ID = oo.ID';
}

function filterStartCountry($startCountry){
    
    return "SELECT oo.id, oo.name, c1.countryName as startCountry, oo.startVillage, c2.countryName as destCountry, oo.destinationVillage, oo.startDate, prod.pr "
                          . "FROM "
                          . "(SELECT p.productname as pr, o.ID "
                          . "FROM productsorgajoin poj "
                          . "join products p on poj.ID_product = p.ID "
                          . "join organisation_offer o on poj.ID_organisationOffer = o.ID) prod, organisation_offer oo "
                          . "join countries c1 on oo.startCountry = c1.id "
                          . "join countries c2 on oo.destinationCountry = c2.ID "
                          . "WHERE prod.ID = oo.ID AND startCountry = (Select ID FROM countries where countryName = '$startCountry')";
}

function filterDestCountry($destCountry){
    
    return "SELECT oo.id, oo.name, c1.countryName as startCountry, oo.startVillage, c2.countryName as destCountry, oo.destinationVillage, oo.startDate, prod.pr "
                          . "FROM "
                          . "(SELECT p.productname as pr, o.ID "
                          . "FROM productsorgajoin poj "
                          . "join products p on poj.ID_product = p.ID "
                          . "join organisation_offer o on poj.ID_organisationOffer = o.ID) prod, organisation_offer oo "
                          . "join countries c1 on oo.startCountry = c1.id "
                          . "join countries c2 on oo.destinationCountry = c2.ID "
                          . "WHERE prod.ID = oo.ID AND destinationCountry = (Select ID FROM countries where countryName = '$destCountry')";
}

function filterDatespan($lowerDate, $upperDate){
    
    return "SELECT oo.id, oo.name, c1.countryName as startCountry, oo.startVillage, c2.countryName as destCountry, oo.destinationVillage, oo.startDate, prod.pr "
                          . "FROM "
                          . "(SELECT p.productname as pr, o.ID "
                          . "FROM productsorgajoin poj "
                          . "join products p on poj.ID_product = p.ID "
                          . "join organisation_offer o on poj.ID_organisationOffer = o.ID) prod, organisation_offer oo "
                          . "join countries c1 on oo.startCountry = c1.id "
                          . "join countries c2 on oo.destinationCountry = c2.ID "
                          . "WHERE prod.ID = oo.ID AND startDate >= $lowerDate AND endDate >= $upperDate";
}


