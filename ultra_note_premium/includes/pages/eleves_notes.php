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
<script>
<?php
echo "var notes_matiere={};";

foreach($groupes as $i=>$data){
    echo "notes_matiere[".$data["id"]."]=[];";
}
$requested="SELECT * FROM notes ";
foreach(requete($bdd, $requested) as $i=>$data){
    $note="{'id': ".$data["id"]."}";
    echo "notes_matieres.push(".$note.");"
}
 
?>
</script>
<div>

<div class="row">

    <div>
        <table>
            <thead>
                <tr></tr>
           </thead>
            
           <tbody id="tableau_note">

           </tbody>
        </table>
    </div>

</div>