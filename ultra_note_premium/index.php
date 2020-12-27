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
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
        <link href="css/index_dark.css" rel="stylesheet" />
        <link href="css/style_dark.css" rel="stylesheet" />
        <script src="js/index.js"></script>
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
                        <input name="cpassword" id="cpassword" type="text" class="i_form"/>
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
                <input style="display:none;" name="iclasses" value="" />
                <input style="display:none;" name="igroupes" value="" />
                <input style="display:none;" name="ienfants" value="" />
                <h2>Enregistrez vous ! </h2>
                <div >
                    <div class="frow">
                        <label >Vous etes : </label>
                        <select name="itype" id="stype" onchange="update_inscription();" class="i_form">
                            <option value="eleve">un élève</option>
                            <option value="prof">un professeur</option>
                            <option value="admin">un administrateur</option>
                            <option value="parent">un parent</option>
                        </select>
                    </div>
                    <div class="frow">
                        <label >nom : </label>
                        <input name="inom" id="inom" type="text" class="i_form"/>
                    </div>
                    <div class="frow">
                        <label >prénom : </label>
                        <input name="iprenom" id="iprenom" type="text" class="i_form"/>
                    </div>
                    <div class="frow">
                        <label >pseudo : </label>
                        <input name="ipseudo" id="ipseudo" type="text" class="i_form"/>
                    </div>
                    <div class="frow">
                        <label >password : </label>
                        <input name="ipassword" id="ipassword" type="password" class="i_form"/>
                    </div>
                    <div class="frow">
                        <label >password (verify) : </label>
                        <input name="ipassword2" id="ipassword2" type="password" class="i_form"/>
                    </div>
                    <div class="frow">
                        <label >Date de naissance : </label>
                        <select name="ijour" id="ijour" class="i_form">
                            <?php
for($x = 1; $x <= 31; $x++){
    echo "<option>".$x."</option>";
}
                            ?>
                        </select>
                        <select name="imois" id="imois" class="i_form">
                            <?php
for($x = 1; $x <= 12; $x++){
    echo "<option>".$x."</option>";
}
                            ?>
                        </select>
                        <select name="ian" id="ian" class="i_form">
                        <?php
for($x = 1990; $x <= 2010; $x++){
    echo "<option>".$x."</option>";
}
                            ?>
                        </select>
                    </div>
                    <div id="ielprof">
                        <div class="frow">
                        <label>Établissement : </label>
                            <select id="ietablissement" name="ietablissement" class="i_form">
<?php
foreach(get_etablissements($bdd) as $k=>$v){
    echo "<option value=".$v["id"].">".$v["nom"]."</option>";
}
?>
                            </select>
                        </div>
                    </div>

                    <div id="ieleve">
                        <div class="frow"><label>Classe : </label>
                            <select id="iclasse" name="iclasse" class="i_form">
<?php
$classes = get_classes($bdd);
foreach($classes as $k=>$v){
    echo("<option>".$v["niveau"].", ".$v["nom"]."</option>");
}
?>
                            </select>
                        </div>
                    </div>
                    <div id="iprof" style="display:none;">
                        <div class="row frow">
                            <label>Matieres :</label>
                            <div id="smats"></div>
                            <a class="bt_m" href="#" onclick="rem('smats');"> - </a>
                            <a class="bt_m" href="#" onclick="add_mat();"> + </a>
                        </div>

                        <div class="row">
                            <label>Groupes/Classes :</label>
                            <div id="sgrps"></div>
                            <a class="bt_m" href="#" onclick="rem('sgrps');"> - </a>
                            <a class="bt_m" href="#" onclick="add_grp();"> + </a>
                        </div>
                    </div>
                    <div id="iadmin" style="display:none;">

                    </div>
                    <div id="iparent" style="display:none;">

                        <div class="row frow">
                            <label>Enfants :</label>
                            <div id="senfs"></div>
                            <a class="bt_m" href="#" onclick="rem('senfs');"> - </a>
                            <a class="bt_m" href="#" onclick="add_enf();"> + </a>
                        </div>
                    </div>
                    <div class="m_r">
                        <a class="bt_form" href="#" onclick="before_submit();">S'inscrire</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- Infos -->
        <div id="divinfo">

        </div>
    </body>
</html>