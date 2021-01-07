<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$id_prof = $_SESSION["id"];
$mats = requete($bdd,"SELECT * FROM matieres");
$notes = requete($bdd,"SELECT * FROM notes");

$matieres=array();
foreach($mats as $i=>$data){
    $matieres[$data["id"]]=$data["nom"];
}

?>

<div>

<?php


$requete = "SELECT * FROM profs_groupes INNER JOIN groupes ON id_groupe=groupes.id WHERE id_prof=".$id_prof;
foreach(requete($bdd, $requete) as $i=>$data){
    $data["nom"];
    echo "<table class='tableau_note'> <tr class='ligne_titre_note'> <td>".$data["nom"]."</td> <td>".$data[""]."</td>  </tr>";
}
    echo "</table>";


?>

</div>