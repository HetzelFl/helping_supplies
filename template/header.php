<div id='menubg'>
</div>
<div class="container" style="margin-top:-52px;">
    <a class="logo" href="#">Paul</a>
    <div id='cssmenu'>
        <ul>
            <li><a href='#'>Start</a></li>
            <li class='has-sub'><a href='#'>Angebote</a>
                <ul>
                    <li><a href='../showOffer/orgaAngebotAuflisten.php'>von Organisationen</a></li>
                    <li><a href='../showOffer/deliverAngebotAuflisten.php'>von Privat</a></li>

                </ul>
            </li>
            <li class='has-sub'><a href='#'>Eigene Angebote</a>
                <ul>

                    <li class='has-sub'><a href='#'>Einstellen</a>
                        <ul>
                            <li><a href='../AngebotErstellen/create_Offer_Orga_HTML.php'>von Organisation</a></li>
                            <li><a href='../AngebotErstellen/create_Offer_Deliver_HTML.php'>von Privat</a></li>
                        </ul>
                    <li><a href='../AngebotEditieren/list_Own_Orga.php'>Auflisten</a></li>
                </ul>
            </li>
            <li><a href='#'>Account</a></li>
            <li><a href='#'>Logout</a></li>
            <li><a href='#'>Contact</a></li>
        </ul>
    </div>
</div>

<?php
//Wenn nicht eingelogt:
if (!isset($_SESSION['accountsId'])) {
    include($root . "/helping_supplies/template/infobox.php");
}
?>