<div id='menubg'>
</div>
<div class="container" style="margin-top:-52px;">
    <a class="logo" href="/helping_supplies/index.php">Paul</a>
    <div id='cssmenu'>
        <ul>
            <li><a href='/helping_supplies/index.php'>Start</a></li>
            <li class='has-sub'><a href='#'>Angebote</a>
                <ul>
                    <li><a href='/helping_supplies/showOffer/orgaAngebotAuflisten.php'>von Organisationen</a></li>
                    <li><a href='/helping_supplies/showOffer/deliverAngebotAuflisten.php'>von Privat</a></li>

                </ul>
            </li>
            <?php
            if (isset($_SESSION['accountsId'])) {
                ?>
                <li class='has-sub'><a href='#'>Eigene Angebote</a>
                    <ul>

                        <li class='has-sub'><a href='#'>Einstellen</a>
                            <ul>
                                <li><a href='/helping_supplies/AngebotErstellen/create_Offer_Orga_HTML.php'>von Organisation</a></li>
                                <li><a href='/helping_supplies/AngebotErstellen/create_Offer_Deliver_HTML.php'>von Privat</a></li>
                            </ul>
                        <li><a href='/helping_supplies/AngebotEditieren/list_Own_Orga.php'>Auflisten</a></li>
                    </ul>
                </li>
                <?php
                if (isset($_SESSION['accountsAdmin'])) {
                    echo "<li><a href='/helping_supplies/Admin/adminPanel_HTML.php'>Admin Panel</a></li>";
                }
                ?>
                <li><a href='/helping_supplies/account/edit-account.php'>Account</a></li>
                <li><a href='/helping_supplies/registration/logout.php'>Logout</a></li>
                <?php
            } else {
                ?>
                <li><a href='/helping_supplies/registration/login.php'>Login</a></li>
                <li><a href='/helping_supplies/registration/reg.php'>Registrierung</a></li>
                <?php
            }
            ?>
            <li><a href='/helping_supplies/contact/contact.php'>Kontakt</a></li>
        </ul>
    </div>
</div>

<?php
//Infobox anzeigen
// Wenn nicht im registration Verzeichnis
if (strpos(getcwd(), 'registration') == false) {
    include($root . "/helping_supplies/template/infobox.php");
}