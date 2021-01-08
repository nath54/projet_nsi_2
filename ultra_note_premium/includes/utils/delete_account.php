<?php

$pathe=explode(DIRECTORY_SEPARATOR,getcwd());
$laste=$pathe[count($pathe)-1];
if($laste=="pages" || $laste=="utils"){
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