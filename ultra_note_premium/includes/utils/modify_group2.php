<?php

/*
Ici, on va faire un include sur le fichier `init.php`,
qui chargera la session ainsi que quelques petites fonctons en php,
On va aussi inclure le fichier `bdd.php`, 
qui nous permet de récupérer la base de donnée (fonction load_db),
et qui fourni aussi quelques fonctions utiles pour l'interaction avec la base de donnée,
les plus utilisées sont `requete()` et `action()`,
qui servent respectivement à récuperer des tableaux et à faire des modifications à la base de donnée.

J'ai du mettre sous cette forme à cause d'un probleme de chemins pour acceder au fichiers, 
du a l'arborescence de fichiers du projets, qui commence a etre certe sophistiquée,
mais aussi surtout bien utile lorsqu'il s'agit de s'organiser
*/
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