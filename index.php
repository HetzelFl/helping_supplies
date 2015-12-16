<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/Paul-flo/template/head.php");
include($root . "/Paul-flo/template/header.php");

//optional
include($root . "/Paul-flo/template/infobox.php");
//content
?>

<div class="container">
    <h1>Responsive Template 01</h1>

    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
    </p>

    <hr>

    <div class="row">
        <div class="one-third column value">
            <div class="centering">
                <h2><strong>33 %</strong></h2>
                <h5>Lorem Ipsum</h5>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor.</p>
            </div>
        </div>
        <div class="one-third column value">
            <div class="centering">
                <h2><strong>33 %</strong></h2>
                <h5>Lorem Ipsum</h5>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor.</p>
            </div>
        </div>
        <div class="one-third column value">
            <div class="centering">
                <h2><strong>33 %</strong></h2>
                <h5>Lorem Ipsum</h5>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor.</p>
            </div>
        </div>
    </div>

    <hr>

    <h1>Lorem ipsum dolor sit amet, onsetetur sadipscing elitr.</h1>
    <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    </p>

    <hr>

    <!-- Standard Headings -->
    <h1>Heading h1</h1>
    <h2>Heading h2</h2>
    <h3>Heading h3</h3>
    <h4>Heading h4</h4>
    <h5>Heading h5</h5>
    <h6>Heading h6</h6>

    <hr>

    <h1>Formulare</h1>
    <form>
        <div class="row">
            <div class="six columns">
                <label for="exampleEmailInput">E-Mail</label>
                <input class="u-full-width" type="email" placeholder="test@mailbox.com" id="exampleEmailInput">
            </div>
            <div class="six columns">
                <label for="exampleRecipientInput">Grund der Nachricht</label>
                <select class="u-full-width" id="exampleRecipientInput">
                    <option value="Option 1">Fragen</option>
                    <option value="Option 2">Probleme</option>
                    <option value="Option 3">Feedback</option>
                </select>
            </div>
        </div>
        <label for="exampleMessage">Message</label>
        <textarea class="u-full-width" placeholder="Ihre Nachricht..." id="exampleMessage"></textarea>
        <label class="example-send-yourself-copy">
            <input type="checkbox">
            <span class="label-body">Eine Kopie an mich selbst senden</span>
        </label>
        <input class="button-primary" type="submit" value="Submit">
    </form>

    <hr>

    <h1>Tabellen</h1>
    <table class="u-full-width">
        <thead>
            <tr>
                <th>Orga</th>
                <th>Start</th>
                <th>Ziel</th>
                <th>Datum</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>DRK</td>
                <td>DE</td>
                <td>FR</td>
                <td>2.2.12</td>
            </tr>
            <tr>
                <td>Tu Gutes</td>
                <td>JAP</td>
                <td>FI</td>
                <td>01.09.2015</td>
            </tr>
        </tbody>
    </table>

</div>

<?php
include($root . "/Paul-flo/template/footer.php");
?>