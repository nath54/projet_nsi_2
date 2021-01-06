<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$id_prof = $_SESSION["id"];

$groupes = requete($bdd, "SELECT groupes.* FROM groupes INNER JOIN profs_groupes ON groupes.id=id_groupe AND id_prof=".$id_prof)

?>

<style>
#div_nouveau{
    position: absolute;
    top: 5%;
    left:10%;
    right: 10%;
    bottom: 5%;
    background-color: rgba(50, 50, 50, 0.95);
    padding: 20px;
}
</style>

<div>

<?php

foreach($groupes as $i=>$data){
    echo "<div>";
    echo "<h1>".$data["nom"]."</h1>";
    echo "<button onclick='nouveau_devoir(".$data["id"].")'>Nouveau devoir</button>";
    echo "</div>";
}

?>

</div>

<div id="div_nouveau" style="display:none;">
    <form>
        <h1>Nouveau devoir</h1>
        <select id="id_groupe" name="id_groupe">

        </select>
        <div>
            <label>Titre :</label>
            <input type="text" id="titre" name="titre" value="" placeholder="exemple: Exercices de Math"/>
        </div>
        <div>
            <label>Description :</label>
            <input type="textarea" id="description_" name="description_" value="" placeholder="exemple: Faire les exercices 4 et 2 de la page 42 du manuel"/>
        </div>
        <div>
            <label>jour :</label>
            <input type="date" id="date" name="date"/>
        </div>
        <div>
            <label>Mettre dans le devoir le temps qu'il demandera (environ)</label>
            <input type="checkbox" name="mettre_temps" id="mettre_temps" />
        </div>
        <div>
            <label>Temps que le devoir prendra :</label>
            <input type="number" id="temps" name="temps" value="" placeholder="5"/><span> minutes</span>
        </div>
        <div class="row">
            <a href="#" onclick="submite()">Envoyer</a>
            <a href="#" onclick="document.getElementById('div_nouveau').style.display='none'">Annuler</a>
        </div>
    </form>
</div>

<script>

function nouveau_devoir(id_groupe){
    document.getElementById("div_nouveau").style.display="initial";
}

function submite(){
    
}

</script>