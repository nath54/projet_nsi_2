<style>

/*
On peut se permettre ici de mettre les propriétés du tableau directement avec table, tr, td et th
car il n'y aura pas d'autre tableaux sur cette page avec lesquels ces propriétés peuvent déranger
*/

table, tr, td, th{
    border: 1px solid rgb(150,150,150);
    border-collapse: collapse;
}

table{
    width: 90%;
    margin: 15px;
    margin-right: 30px;
    border-color: rgb(150,150,150);
    overflow-y: scroll;
    max-height: 300px;
}

td, th{
    padding: 10px;
}
th{
    background-color: rgb(20,20,20);
    font-size: 1.05em;
    box-shadow: inset -1px 1px rgb(160,160,160), 0 1px rgb(150,150,150);
}
.apres{
    background-color: rgb(40,40,40);
    font-size: 1em;
}.ancient{
    background-color: rgb(70,70,70);
    color: rgb(180, 180, 180);
}
thead{
    position: sticky;
    top: 0;
}
tbody{
    overflow-y: auto;
    max-height: 600px;
}

.descr{
    word-wrap: wrap;
    margin: 2.5px;
    padding: 2.5px;
    padding-left: 5px;
    background-color: rgba(255,255,255, 0.05);
    border-radius: 5px;
}

</style>
<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$id_eleve = $_SESSION["id"];

?>
<script>

var devoirs=[];

<?php
foreach(requete($bdd, "SELECT devoirs.*, matieres.nom FROM devoirs INNER JOIN matieres ON devoirs.id_matiere=matieres.id INNER JOIN groupes ON devoirs.id_groupe=groupes.id INNER JOIN eleves_groupes ON eleves_groupes.id_groupe=groupes.id AND eleves_groupes.id_eleve=".$id_eleve) as $i=>$data){
    $dev="{'id': ".$data["id"].", 'jour': '".$data["jour"]."', 'nom': '".$data["nom"]."', 'titre': '".$data["titre"]."', 'description_': '".$data["description_"]."'}";
    echo "devoirs.push(".$dev.")";
}

?>

</script>

<div>

<?php

?>

</div>