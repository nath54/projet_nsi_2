<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=viewport-width, initial-scale=1">
        <title>UltraNote++ Premium Edition</title>
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Header -->
        <div>
            <div>
                <h2>UltraNote</h2>
            </div>
        </div>
        <!-- Acceuil -->
        <div id="accueil">
            <div class="box1">
                <h1>UltraNote++ Premium Edition</h1>
                <h2>Vivez dans un monde a votre époque</h2>
                <p class="text_moyen">UltraNote est un outil de travail numérique qui vous accompagne tout au long de votre année scolaire, les professeurs autant que les élèves.</p>
            </div>
            <div class="box2">
                <h2>(re)venez avec nous !</h2>
                <div class="buttons_acc">
                    <button class="bt_acc" onclick="to_connect();">Se connecter</button>
                    <button class="bt_acc" onclick="to_inscription();">S'inscrire</button>
                </div>
            </div>
        </div>
        <!-- Connection -->
        <div id="divconnect">
            <button onclick="to_acceuil();">X</button>
            <form id="fconnect" name="fconnect", method="POST", action="includes/connection.php" >
                <h2>Connection</h2>
                <div >
                    <div >
                        <label >pseudo : </label>
                        <input name="cpseudo" id="cpseudo" type="text" />
                    </div>
                    <div >
                        <label >mot de passe : </label>
                        <input name="cpassword" id="cpassword" type="text" />
                        <button >Se connecter</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Inscription -->
        <div id="divinscription">
            <button onclick="to_acceuil();">X</button>
            <form id="finscription" name="finscription", method="POST", action="includes/inscription.php" >
                <h2>Enregistrez vous ! </h2>
                <div >
                    <div >
                        <label >pseudo : </label>
                        <input name="ipseudo" id="ipseudo" type="text" />
                    </div>
                    <div >
                        <label >mot de passe : </label>
                        <input name="ipassword" id="ipassword" type="text" />
                    </div>
                    <div>
                        <button >S'inscrire</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Infos -->
        <div id="divinfo">

        </div>
    </body>
    <script src="js/index.js"></script>
</html>