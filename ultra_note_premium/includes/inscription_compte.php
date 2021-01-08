<?php

$pathe=explode(DIRECTORY_SEPARATOR,getcwd());
$laste=$pathe[count($pathe)-1];
if($laste=="pages"){
    include_once("../init.php");
    include_once("../bdd.php");
    $bdd=load_db("../");
}
else if($laste=="includes"){
    include_once("init.php");
    include_once("bdd.php");
    $bdd=load_db("");
}
else if($laste=="ultra_note_premium"){
    include_once("includes/init.php");
    include_once("includes/bdd.php");
    $bdd=load_db("includes/");
}


$mode="defaut";
if(isset($_GET["mode"])){
    $mode=$_GET["mode"];
}
if(isset($_SESSION["mode_inscription"])){
    $mode=$_SESSION["mode_inscription"];
}


// GET MATIERES
$txt="<script>var matieres = {";
foreach(get_matieres($bdd) as $k=>$v){
    $txt=$txt."'".$v["nom"]."':".$v["id"].",";
}

if(endsWith($txt, ",")){
    $txt=substr($txt, 0, -1);
}
$txt=$txt."};</script>";
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
$classes = get_classes($bdd);
$txt="<script>var grpclasses = {";
foreach(requete($bdd, "SELECT * FROM groupes;") as $k=>$v){
    $txt=$txt.$v["id"].":"."'GROUPE : ".$v["nom"]."',";
}
if(endsWith($txt, ",")){
    $txt=substr($txt, 0, -1);
}
$txt=$txt."};</script>";
echo $txt;

// PREP MODIF

$mod=false;
$jb=null;
$mb=null;
$ab=null;
if( isset($_SESSION["id_compte_modif"]) ){
    $idc=$_SESSION["id_compte_modif"];
    $mod=true;
    $dc = requete($bdd, "SELECT * FROM comptes WHERE id=".$idc.";")[0];
    $dcl = explode("-", $dc["naissance"]);
    $jb = intval($dcl[2]);
    $mb = intval($dcl[1]);
    $ab = intval($dcl[0]);
}

?>

<div>

    <input id="prof_groupes" name="prof_groupes" style="display:none;" value="" />
    <input id="prof_matieres" name="prof_matieres" style="display:none;" value="" />
    <input id="parent_enfants" name="parent_enfants" style="display:none;" value="" />

    <div class="frow">
        <?php
            if($mode=="defaut"){echo "<label >Vous etes : </label>";}
            else if($mode=="admin"){echo "<label >Type du compte : </label>";}
        ?>
        <select name="itype" id="stype" onchange="update_inscription();" class="i_form">
            <option value="eleve" <?php if($mod && $dc["type_"]=="eleve"){ echo "selected"; } ?> >un élève</option>
            <option value="prof" <?php if($mod && $dc["type_"]=="prof"){ echo "selected"; } ?>>un professeur</option>
            <option value="admin" <?php if($mod && $dc["type_"]=="admin"){ echo "selected"; } ?>>un administrateur</option>
            <option value="parent" <?php if($mod && $dc["type_"]=="parent"){ echo "selected"; } ?>>un parent</option>
        </select>
    </div>
    <div class="frow">
        <label >nom : </label>
        <input name="inom" id="inom" type="text" class="i_form" <?php if($mod){ echo "value='".$dc["nom"]."'"; } ?>/>
    </div>
    <div class="frow">
        <label >prénom : </label>
        <input name="iprenom" id="iprenom" type="text" class="i_form"  <?php if($mod){ echo "value='".$dc["prenom"]."'"; } ?>/>
    </div>
    <div class="frow">
        <label >pseudo : </label>
        <input name="ipseudo" id="ipseudo" type="text" class="i_form"  <?php if($mod){ echo "value='".$dc["pseudo"]."'"; } ?>/>
    </div>
    <div class="frow">
        <label >password : </label>
        <input name="ipassword" id="ipassword" type="password" class="i_form" <?php if($mod){ echo "placeholder='Keep Empty to Keep'"; } ?> />
        <img class="bt_oeil" onclick="toggle_password('ipassword');">
    </div>
    <div class="frow">
        <label >password (verify) : </label>
        <input name="ipassword2" id="ipassword2" type="password" class="i_form" <?php if($mod){ echo "placeholder='Keep Empty to Keep'"; } ?> />
        <img class="bt_oeil" onclick="toggle_password('ipassword2');">
    </div>
    <div class="frow">
        <label >Date de naissance : </label>
        <select name="ijour" id="ijour" class="i_form">
            <?php
    for($x = 1; $x <= 31; $x++){
        if($x == $jb){ echo "<option selected>".$x."</option>"; }
        else{ echo "<option >".$x."</option>"; }
    }
            ?>
        </select>
        <select name="imois" id="imois" class="i_form">
            <?php
    for($x = 1; $x <= 12; $x++){
        if($x == $mb){ echo "<option selected>".$x."</option>"; }
        else{ echo "<option >".$x."</option>"; }
    }
            ?>
        </select>
        <select name="ian" id="ian" class="i_form">
        <?php
    for($x = 1945; $x <= 2010; $x++){
        if($x == $ab){ echo "<option selected>".$x."</option>"; }
        else{ echo "<option >".$x."</option>"; }
    }
            ?>
        </select>
    </div>
    <div id="ielprofadmin">
        <div class="frow">
        <label>Établissement : </label>
            <select id="ietablissement" name="ietablissement" class="i_form">
    <?php
    foreach(get_etablissements($bdd) as $k=>$v){
        if($v["id"]==$dc["id_etablissement"]){ echo "<option value=".$v["id"]." selected >".$v["nom"]."</option>"; }
        else{ echo "<option value=".$v["id"].">".$v["nom"]."</option>"; }
    }
    ?>
            </select>
        </div>
    </div>

    <div id="ieleve">
        <div class="frow"><label>Classe : </label>
            <select id="id_classe" name="id_classe" class="i_form">
    <?php
    if($mod){
        $r = requete($bdd, "SELECT * FROM eleves_classes WHERE id_eleve=".$dc["id"].";");
        if(count($r)>0){
            $classe_eleve=$r[0];
        }
        else{
            $classe_eleve=array();
            $classe_eleve["id_classe"]=null;
        }

        foreach($classes as $k=>$v){
            // alert($v["id"]."-".$classe_eleve["id_classe"]);
            if($v["id"]==$classe_eleve["id_classe"]){
                echo("<option value=".$v["id"]." selected>".$v["niveau"].", ".$v["nom"]."</option>");
            }else{
                echo("<option value=".$v["id"].">".$v["niveau"].", ".$v["nom"]."</option>");
            }
        }
    }
    else{
        foreach($classes as $k=>$v){
            echo("<option value=".$v["id"].">".$v["niveau"].", ".$v["nom"]."</option>");
        }
    }

    ?>
            </select>
        </div>
    </div>
    <div id="iprof" style="display:none;">
        <div class="row frow">
            <label>Matieres :</label>
            <div id="smats">
            </div>
            <a class="bt_m" href="#" onclick="rem('smats');"> - </a>
            <a class="bt_m" href="#" onclick="add_mat();"> + </a>
        </div>

        <div class="row">
            <label>Groupes :</label>
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
            else if($mode=="admin"){
                if($mod){
                    echo "Modifier le compte";
                }
                else{
                    echo "Créer le compte";
                }
            }
        ?></a>
        <a class="bt_form" href="#" onclick="gen_el();">Génerer</a>
    </div>

</div>
<script>
update_inscription();
<?php
if($mod){
    if($dc["type_"]=="prof"){
        $requete = "SELECT * FROM profs_matieres INNER JOIN matieres ON matieres.id = id_matiere WHERE id_prof = ".$idc;
        foreach(requete($bdd, $requete) as $i=>$data){
            echo "\nadd_mat(".$data["id"].");";
        }
        $requete = "SELECT * FROM profs_groupes INNER JOIN groupes ON groupes.id = id_groupe WHERE id_prof = ".$idc;
        foreach(requete($bdd, $requete) as $i=>$data){
            echo "\nadd_grp(".$data["id"].");";
        }
    }
}
?>
</script>