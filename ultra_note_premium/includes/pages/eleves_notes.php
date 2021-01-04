<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$matieres = requete($bdd,"SELECT * FROM matiere");
$notes = requete($bdd,"SELECT * FROM notes;");
$eleves_notes = requete($bdd,"SELECT * FROM eleves_notes WHERE id_eleve = ".$_SESSION["id"]);
alert($notes);

?>

<div>
</div>