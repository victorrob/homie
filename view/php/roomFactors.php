<head>
    <link rel="stylesheet" href="/view/css/roomFactors.css" />
</head>
<html>
    <section id="piece">
        <div id="pieceName"></div>
        <br id="la" />
        <div id="ligne">
            <div>
                Lumière :
                <input class="switch" name="lumiere" id="lumiere" type="checkbox" checked />
                <label for="lumiere" class="ui-content" >
                    <div class="ui-switch-range">
                        <div class="ui-switch-handle">
                        </div>
                    </div>
                </label>
            </div>
            <div>
                Chauffage : <form><input type="number" name="chauffage"> °C</form>
            </div>
            <div>
                Ventilation : <form><input type="number" name="ventilation"></form>
            </div>
        </div>
        <div>
            Volets :
            <div>
                <input class="switch" name="volets1" id="volets1" type="checkbox" checked />
                <label for="volets1" class="ui-content" >
                    <div class="ui-switch-range">
                        <div class="ui-switch-handle">
                        </div>
                    </div>
                </label>
            </div>
            <div>
                <input class="switch" name="volets2" id="volets2" type="checkbox" checked />
                <label for="volets2" class="ui-content" >
                    <div class="ui-switch-range">
                        <div class="ui-switch-handle">
                        </div>
                    </div>
                </label>
            </div>
        </div>
        <div>
            Plage horaire : <form><input type="time" name="ouverture" /> - <input type="time" name="fermeture" /></form>
        </div>
        <div><a href="#"><p>Statistiques</p></a></div>
    </section>

    <script type="text/javascript" src="/view/js/roomFactors.js"></script>

</html>

