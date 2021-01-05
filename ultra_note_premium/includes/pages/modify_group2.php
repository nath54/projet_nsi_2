<?php

include_once "../init.php";
include_once "../bdd.php";

$bdd = load_db("../");

if(isset($_POST["eleves_groups"])){
    $eleves_group = explode("|", $_POST["eleves_groups"]);
    $id_groupe = $_POST["id_groupe"];
    action($bdd, "DELETE FROM eleves_groupes WHERE id_groupe=".$id_groupe);
    foreach($eleves_group as $i=>$ide){
        action($bdd, "INSERT INTO eleves_groupes SET id_groupe=".$id_groupe.", id_eleve=".$ide);
    }
    echo "<script>window.location.href='../../main.php?page=etablissement_admin';</script>";
}

?>