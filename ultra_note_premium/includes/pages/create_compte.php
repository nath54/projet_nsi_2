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

/*
On teste si le compte qui accede a cette page a bien les permissions pour y acceder,
cela évite un tres gros trou de sécurité
*/
test_compte($bdd, "admin");

?>
<form id="finscription" method="POST", action="includes/utils/create_compte2.php">
<?php
$_SESSION["mode_inscription"]="admin";
include "../inscription_compte.php";
?>
</form>
