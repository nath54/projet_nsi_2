<?php

include "includes/init.php";
include "includes/bdd.php";
$bdd = load_db("includes/");

// GET MATIERES
$txt="<script>var matieres = [";
foreach(get_matieres($bdd) as $k=>$v){
    $txt=$txt."'".$v["nom"]."',";
}

if(endsWith($txt, ",")){
    $txt=substr($txt, 0, -1);
}
$txt=$txt."];</script>";
echo $txt;

// GET ELEVES
$txt="<script>var eleves = {";
foreach(get_eleves($bdd) as $k=>$v){
    $txt=$txt.$v["id"].":"."'".strtoupper($v["nom"])." ".$v["prenom"]."',";
}
if(endsWith($txt, ",")){
    $txt=substr($txt, 0, -1);
}
$txt=$txt."};</script>";
echo $txt;



// GET GROUPES/CLASSES
$txt="<script>var grpclasses = {";
foreach(get_classes($bdd) as $k=>$v){
    $txt=$txt."'cla_".$v["id"]."':"."'CLASSE : ".$v["nom"]."',";
}
foreach(get_groupes($bdd) as $k=>$v){
    $txt=$txt."'grp_".$v["id"]."':"."'GROUPE : ".$v["nom"]."',";
}
if(endsWith($txt, ",")){
    $txt=substr($txt, 0, -1);
}
$txt=$txt."};</script>";
echo $txt;

?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=viewport-width, initial-scale=1">
        <title>UltraNote++ Premium Edition</title>
        <!--
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
        -->
        <link href="css/google_fonts/arvo.css" rel="stylesheet" />
        <link href="css/google_fonts/lato.css" rel="stylesheet" />
        <link href="css/index_dark.css" rel="stylesheet" />
        <link href="css/style_dark.css" rel="stylesheet" />
        <script src="js/lib.js"></script>
        <script src="js/index.js"></script>
        <script src="js/forms.js"></script>
    </head>
    <body id="body_index">
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
                    <div class="frow">
                        <label >pseudo : </label>
                        <input name="cpseudo" id="cpseudo" type="text" class="i_form"/>
                    </div>
                    <div class="frow">
                        <label >mot de passe : </label>
                        <input name="cpassword" id="cpassword" type="password" class="i_form"/>
                        <img class="bt_oeil" onclick="toggle_password('cpassword');">
                    </div>
                    <div class="m_r">
                        <button class="bt_form">Se connecter</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Inscription -->
        <div id="divinscription">
            <button class="bt_disconect" onclick="to_accueil();">X</button>
            <form id="finscription" name="finscription" method="POST" action="includes/inscription.php" onsubmit="before_submit();">
                <h2>Enregistrez vous ! </h2>
                <?php include "includes/inscription_compte.php" ?>
            </form>
        </div>
        <!-- Infos -->
        <div id="divinfo">

        </div>
    </body>
</html>
<script src="js/prenoms.js"></script>