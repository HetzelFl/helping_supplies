<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/helping_supplies/template/head.php");
include($root . "/helping_supplies/template/header.php");

//optional
//include($root . "/helping_supplies/template/infobox.php");
//content
?>

<div class="container">
    <h1>DRK: Von Deutschland nach Afghanistan</h1>
    <table class="u-full-width">
        <tr>
            <th>Organisation</th>
            <td>DRK</td>
            <th>Kontaktperson</th>
            <td>Fr. Hill</td>
        </tr>
        <tr>
            <th>Verfügbar ab</th>
            <td>24.12.2015</td>
            <th>Verfügbar bis</th>
            <td>18.9.2016</td>
        </tr>
        <tr>
            <th>Startland</th>
            <td>Deutschland</td>
            <th>Startstadt</th>
            <td>Freiburg</td>
        </tr>
        <tr>
            <th>Zielland</th>
            <td>Afghanistan</td>
            <th>Zielstadt</th>
            <td>Marjah</td>
        </tr>
    </table>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
    <p><b>Zu transportierende Hilfsgüter:</b> Obst, Paul, Kleidung, Medekamente</p>
    <form action="contact.php?id13,typ:oga" method="post" style="text-align:right;">
        <input class="button-primary" type="submit" value="Kontaktieren">
    </form>

<div class="responsiveGMaps">
    <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Afghanistan,Marjah&key=AIzaSyCP4tAaRU6nhhE0tdEtE3U3mqp1JJUgnwA" allowfullscreen></iframe>
</div>
</div>

<?php
include($root . "/helping_supplies/template/footer.php");
