<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$mats = requete($bdd,"SELECT * FROM matieres");
$notes = requete($bdd,"SELECT * FROM notes");

$matieres=array();
foreach($mats as $i=>$data){
    $matieres[$data["id"]]=$data["nom"];
}

?>

<div>

<?php

foreach($notes as $i=>$data_note){
    echo "<table>"
    foreach(requete($bdd,"SELECT * FROM eleves_notes WHERE id_eleve = ".$_SESSION["id"]." AND id_note = ".$data_note["id"]) as $ii=>$data_eleve){
        
    }
    echo "</table>"
}

?>

</div>