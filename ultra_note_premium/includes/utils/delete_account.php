<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once("$root/projet_nsi_2/ultra_note_premium/includes/init.php");
include_once("$root/includes/bdd.php");

$bdd = load_db("../");

if(isset($_GET["id_account"]) && $_GET["id_account"]!=null){
    action($bdd, "DELETE FROM comptes WHERE id=".$_GET["id_account"]);
    action($bdd, "DELETE FROM eleves_classes WHERE id_eleve=".$_GET["id_account"]);
    action($bdd, "DELETE FROM profs_matieres WHERE id_prof=".$_GET["id_account"]);
    action($bdd, "DELETE FROM profs_groupes WHERE id_prof=".$_GET["id_account"]);
    action($bdd, "DELETE FROM parents_enfants WHERE id_compte=".$_GET["id_account"]);
    echo "<script>alert('Le compte a bien été supprimé');</script>";
}

echo "<script>update();</script>"
?>