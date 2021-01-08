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