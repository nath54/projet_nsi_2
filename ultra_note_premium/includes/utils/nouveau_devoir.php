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

aff_array($_POST);

$titre = $_POST["titre"];
$description = $_POST["description_"];
$id_groupe = $_POST["id_groupe"];
$id_matiere = $_POST["id_matiere"];
$id_prof = $_SESSION["id"];
$jour = $_POST["jour"];
$type_ = $_POST["type_"];
$mettre_temps = isset($_POST["mettre_temps"]);
$temps = $_POST["temps"];

$requested = "INSERT INTO devoirs SET id_prof=".$id_prof.", id_groupe=".$id_groupe.", id_matiere=".$id_matiere.", type_='".$id_matiere."', titre='".$titre."', description_='".$description."', jour='".$jour."'";
if($mettre_temps){
    $requested.=", temps_evalue=".$temps;
}

echo $requested;
action($bdd, $requested);

header("Location: ../../main.php?page=prof_devoirs");

?>