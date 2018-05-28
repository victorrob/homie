<form method="post" action="index.php?d=installateurPage" onsubmit="return check(this)">
    <div>
        <label for="mailClient">Mail du client chez lequel vous intervenez :</label>
        <input type="email" name="mailClient" id="mailClient" class="complete" required />
    </div>
    <div>
        <label for="confirmationMail">Confirmation du mail du client :</label>
        <input type="email" name="confirmationMail" id="confirmationMail" class="complete" required />
    </div>
    <input type="submit" value="Go" />
</form>

<script type="text/javascript" src="view/js/installateurPage.js"></script>