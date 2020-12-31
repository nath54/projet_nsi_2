<?php

$mode="defaut";
if(isset($_GET["mode"])){
    $mode=$_GET["mode"];

}
if(isset($_SESSION["mode_inscription"])){
    $mode=$_SESSION["mode_inscription"];
}

include_once "init.php";
include_once "bdd.php";

$bdd = load_db("../");

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

// PREP MODIF

$mod=false;
if(isset($_SESSION["id_compte_modif"])){
    $mod=true;
    $dc = requete("SELECT * FROM comptes WHERE id=".$_SESSION["id_compte_modif"]);
}

?>

<div class="frow">
    <?php
        if($mode=="defaut"){echo "<label >Vous etes : </label>";}
        else if($mode=="admin"){echo "<label >Type du compte : </label>";}
    ?>
    <select name="itype" id="stype" onchange="update_inscription();" class="i_form">
        <option value="eleve">un élève</option>
        <option value="prof">un professeur</option>
        <option value="admin">un administrateur</option>
        <option value="parent">un parent</option>
    </select>
</div>
<div class="frow">
    <label >nom : </label>
    <input name="inom" id="inom" type="text" class="i_form" <?php if($mod){ echo "value='".$dc["nom"]."'"} ?>/>
</div>
<div class="frow">
    <label >prénom : </label>
    <input name="iprenom" id="iprenom" type="text" class="i_form"  <?php if($mod){ echo "value='".$dc["prenom"]."'"} ?>/>
</div>
<div class="frow">
    <label >pseudo : </label>
    <input name="ipseudo" id="ipseudo" type="text" class="i_form"  <?php if($mod){ echo "value='".$dc["pseudo"]."'"} ?>/>
</div>
<div class="frow">
    <label >password : </label>
    <input name="ipassword" id="ipassword" type="password" class="i_form" placeholder="Keep Empty to Keep" />
    <img class="bt_oeil" onclick="toggle_password('ipassword');">
</div>
<div class="frow">
    <label >password (verify) : </label>
    <input name="ipassword2" id="ipassword2" type="password" class="i_form" placeholder="Keep Empty to Keep"/>
    <img class="bt_oeil" onclick="toggle_password('ipassword2');">
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
    <a class="bt_form" href="#" onclick="before_submit();"><?php
        if($mode=="defaut"){ echo "S'inscrire"; }
        else if($mode=="admin"){ echo "Créer le compte"; }
    ?></a>
</div>