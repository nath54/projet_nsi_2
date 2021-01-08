<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once("$root/projet_nsi_2/ultra_note_premium/includes/init.php");
include_once("$root/includes/bdd.php");

$bdd = load_db("../");

test_admin($bdd);

//on crée les classes
?>
<form id="fgroup" method="POST", action="includes/pages/create_group2.php">
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
