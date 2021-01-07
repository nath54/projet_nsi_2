<?php



$titre = $_POST["titre"];
$description = $_POST["description_"];
$id_groupe = $_POST["id_groupe"];
$id_matiere = $_POST["id_matiere"];
$id_prof = $_SESSION["id"];
$jour = $_POST["jour"];
$mettre_temps = $_POST["mettre_temps"];
$temps = $_POST["temps"];

$requested = "INSERT INTO devoirs SET id_prof=".$id_prof.", id_groupe=".$id_groupe.", id_matiere=".$id_matiere;
if($mettre_temps){
    $requested.="temps_evalue=".$temps;
}




?>