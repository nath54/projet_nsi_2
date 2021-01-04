<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$id_eleve = $_SESSION["id"];
$mats = requete($bdd,"SELECT * FROM matieres");
$notes = requete($bdd,"SELECT * FROM notes");

$matieres=array();
foreach($mats as $i=>$data){
    $matieres[$data["id"]]=$data["nom"];
}

?>

<div>

<?php

foreach($matieres as $id_mat=>$nom){
    $notes = requete($bdd, "SELECT * FROM notes INNER JOIN eleves_notes ON eleves_notes.id_note=notes.id WHERE id_matiere=".$id_mat." AND id_eleve=".$id_eleve);
    if(count($notes)==0){
        continue;
    }
    echo "<table class='tableau_note'> <tr class='ligne_titre_note'> <td>".$nom."</td> <td>notes</td>  </tr>";
    foreach($notes as $ii=>$data_note){
        echo "<tr class='ligne_note'> <td>".$data_note["titre"]."</td> <td>".$data_note["note"]."</td> </tr>";
    }
    echo "</table>";
}

?>

</div>