<?php


include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");

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