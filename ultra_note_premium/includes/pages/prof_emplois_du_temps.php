<style>

.jour{
    width: 25em;
}

</style>
<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$id_prof = $_SESSION["id"];


?>
<script>

var cours=[];

<?php
$requette="SELECT cours.*, matieres.nom, matieres.couleur FROM cours INNER JOIN matieres ON id_matiere=matieres.id WHERE id_prof=".$id_prof;
echo "</script>".$requette."<script>";
foreach(requete($bdd, $requette) as $i=>$data){
    echo "cours.push({'id': ".$data["id"].",'id_matiere': ".$data["id_matiere"].",'id_groupe': ".$data["id_groupe"].",'jour': '".$data["jour"]."','heure_debut': ".$data["heure_fin"].",'heure_fin': ".$data["heure_debut"].",'semaine': ".$data["semaine"]."});";
}
?>

</script>
<div>
    <div id="emplois_du_temps">
        <table>
            <tr>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
            </tr>
            <tr>
                <td id="lundi" class="jour"></td>
                <td id="mardi" class="jour"></td>
                <td id="mercredi" class="jour"></td>
                <td id="jeudi" class="jour"></td>
                <td id="vendredi" class="jour"></td>
                <td id="samedi" class="jour"></td>
            </tr>
        </table>
    </div>
</div>