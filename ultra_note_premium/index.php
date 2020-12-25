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
            <form id="finscription" name="finscription" method="POST" action="includes/inscription.php" onsubmit="before_submit();">
                <input style="display:none;" name="iclasses" value="" />
                <input style="display:none;" name="igroupes" value="" />
                <input style="display:none;" name="ienfants" value="" />
                <h2>Enregistrez vous ! </h2>
                <div >
                    <div >
                        <label >Vous etes : </label>
                        <select name="itype" id="stype" onchange="update_inscription();">
                            <option value="eleve">un élève</option>
                            <option value="prof">un professeur</option>
                            <option value="admin">un administrateur</option>
                            <option value="parent">un parent</option>
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
                        <select name="ijour" id="ijour">
                            <?php
for($x = 1; $x <= 31; $x++){
    echo "<option>".$x."</option>";
}
                            ?>
                        </select>
                        <select name="imoi" id="imoi">
                            <?php
for($x = 1; $x <= 12; $x++){
    echo "<option>".$x."</option>";
}
                            ?>
                        </select>
                        <select name="ian" id="ian">
                        <?php
for($x = 1990; $x <= 2010; $x++){
    echo "<option>".$x."</option>";
}
                            ?>
                        </select>
                    </div>
                    <div id="ielprof">
                        <div>
                        <label>établissement : </label>
                            <select id="setab" name="ietab">
<?php
foreach(get_etablissements($bdd) as $k=>$v){
    echo "<option value=".$v["id"].">".$v["nom"]."</option>";
}
?>
                            </select>
                        </div>
                    </div>

                    <div id="ieleve">
                        <div><label>Classe : </label>
                            <select id="sclasse" name="iclasse">
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
                        <div class="row">
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

                        <div class="row">
                            <label>Enfants :</label>
                            <div id="senfs"></div>
                            <a class="bt_m" href="#" onclick="rem('senfs');"> - </a>
                            <a class="bt_m" href="#" onclick="add_enf();"> + </a>
                        </div>
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