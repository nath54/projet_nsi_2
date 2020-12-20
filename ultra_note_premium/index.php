<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=viewport-width, initial-scale=1">
        <title>UltraNote++ Premium Edition</title><link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Vollkorn&display=swap" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" />
        <script src="js/index.js"></script>
    </head>
    <body>
        <!-- Acceuil -->
        <div id="accueil">
            <div class="box1">
                <h1>UltraNote++ Premium Edition</h1>
                <h2>Vivez dans un monde a votre époque</h2>
                <p class="text_moyen">UltraNote est un outil de travail numérique qui vous accompagne tout au long de votre année scolaire, les professeurs autant que les élèves.</p>
            </div>
            <div class="box2">
                <h2 id="">(Re)venez avec nous !</h2>
                <div class="buttons_acc">
                    <button class="bt_acc_con" onclick="to_connect();">Se connecter</button>
                    <button class="bt_acc_ins" onclick="to_inscription();">S'inscrire</button>
                </div>
            </div>
        </div>
        <!-- Connection -->
        <div id="divconnect">
            <button class="bt_disconect" onclick="to_accueil();">X</button>
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
            <button class="bt_disconect" onclick="to_accueil();">X</button>
            <form id="finscription" name="finscription", method="POST", action="includes/inscription.php" >
                <h2>Enregistrez vous ! </h2>
                <div >
                    <div >
                        <label >Vous etes : </label>
                        <select id="stype" onchange="udpdate_inscription();">
                            <option>un élève</option>
                            <option>un professeur</option>
                            <option>un administrateur</option>
                            <option>un parent</option>
                        </select>
                    </div>
                    <div >
                        <label >pseudo : </label>
                        <input name="ipseudo" id="ipseudo" type="text" />
                    </div>
                    <div >
                        <label >password : </label>
                        <input name="ipassword" id="ipassword" type="password" />
                    </div>
                    <div >
                        <label >password (verify) : </label>
                        <input name="ipassword2" id="ipassword2" type="password" />
                    </div>
                    <div >
                        <label >Date de naissance : </label>
                        <select id="sjd">
                            <?php
for($x = 1; $x <= 31; $x++){
    echo "<option>".$x."</option>";
}
                            ?>
                        </select>
                        <select id="smd">
                            <?php
for($x = 1; $x <= 12; $x++){
    echo "<option>".$x."</option>";
}
                            ?>
                        </select>
                        <select id="sad">
                        <?php
for($x = 1990; $x <= 2010; $x++){
    echo "<option>".$x."</option>";
}
                            ?>
                        </select>
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
</html>