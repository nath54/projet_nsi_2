<?php

$mode="default";
if(isset($_GET["mode"])){
    $mode=$_GET["mode"];
}

?>

<div >
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