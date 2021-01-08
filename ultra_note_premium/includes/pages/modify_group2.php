<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once("$root/projet_nsi_2/ultra_note_premium/includes/init.php");
include_once("$root/includes/bdd.php");

$bdd = load_db("../");

test_admin($bdd);

$id_groupe = $_POST["id_groupe"];
if($_POST["action"]=="delete"){
    action($bdd, "DELETE FROM eleves_groupes WHERE id_groupe=".$id_groupe);
    action($bdd, "DELETE FROM groupes WHERE id=".$id_groupe);
}
else if($_POST["action"]=="modif"){
    $eleves_group = explode("|", $_POST["eleves_groups"]);
    action($bdd, "DELETE FROM eleves_groupes WHERE id_groupe=".$id_groupe);
    foreach($eleves_group as $i=>$ide){
        action($bdd, "INSERT INTO eleves_groupes SET id_groupe=".$id_groupe.", id_eleve=".$ide);
    }
}
echo "<script>window.location.href='../../main.php?page=etablissement_admin';</script>";

?>