<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$notes = requete($bdd,"SELECT * FROM eleves_notes WHERE id_eleve = ".$_SESSION["id"]);
alert($notes);

?>

<div>
</div>