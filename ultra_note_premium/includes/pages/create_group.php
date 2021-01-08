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


test_admin($bdd);

//on crée les classes
?>
<form id="fgroup" method="POST", action="includes/utils/create_group2.php">
    <h1>Nouveau Groupe</h1>
    <div>
        <label>Nom</label>
        <input type="text" name="nom"/>
    </div>
    <div>
        <label>Niveau</label>
        <select name="niveau">
            <option>seconde</option>
            <option>premiere</option>
            <option>terminale</option>
        </select>
    </div>
    <div>
        <label>Etablissement</label>
        <select name="etablissement">
            <?php
foreach(requete($bdd, "SELECT id,nom FROM etablissements") as $i=>$data){
    echo "<option value=".$data["id"].">".$data["nom"]."</option>";
}
            ?>
        </select>
    </div>
    <button>Creer le groupe</button>
</form>
