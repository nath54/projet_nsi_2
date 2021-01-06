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
    top: 15%;
    left:20%;
    right: 20%;
    bottom: 25%;
    background-color: rgba(60, 60, 60, 0.96);
    border-radius: 25px;
    padding: 20px;
}

.elt_nv_devoir{
    margin: 15px;
    display: flex;
    flex-direction:row;
}

</style>

<div>

<?php

foreach($groupes as $i=>$data){
    echo "<div>";
    echo "<h1>".$data["nom"]."</h1>";
    echo "<button onclick='nouveau_devoir(".$data["id"].");'>Nouveau devoir</button>";
    echo "</div>";
}

?>

</div>

<div id="div_nouveau" style="display:none;">
    <form name="nouveau_devoir" id="f_nouveau_devoir" action="nouveau_devoir.php" method="POST">
        <input id="id_groupe" name="id_groupe" value="" style="display:none;" />
        <h1>Nouveau devoir</h1>
        <div class="elt_nv_devoir">
            <label>Matiere :</label>
            <select id="id_matiere" name="id_matiere">
                <?php
foreach(requete("SELECT matieres.nom, matieres.id FROM matieres INNER JOIN profs_matieres ON matieres.id=id_matiere AND id_prof=".$id_prof) as $i=>$data){
    echo "<option value=".$data["id"].">".$data["nom"]."</option>";
}
                ?>
            </select>
        </div>
        <div class="elt_nv_devoir">
            <label>Titre :</label>
            <input type="text" id="titre" name="titre" value="" placeholder="exemple: Exercices de Math"/>
        </div>
        <div class="elt_nv_devoir">
            <label>Description :</label>
            <input type="textarea" id="description_" name="description_" value="" placeholder="exemple: Faire les exercices 4 et 2 de la page 42 du manuel"/>
        </div>
        <div class="elt_nv_devoir">
            <label>jour :</label>
            <input type="date" id="date" name="date"/>
        </div>
        <div class="elt_nv_devoir">
            <label>Mettre dans le devoir le temps qu'il demandera (environ)</label>
            <input type="checkbox" name="mettre_temps" id="mettre_temps" onchange="if(document.getElementById('mettre_temps').checked){ document.getElementById('dtemps').style.display='initial'; }else{ document.getElementById('dtemps').style.display='none'; }" />
        </div>
        <div id="dtemps" class="elt_nv_devoir">
            <label>Temps que le devoir prendra :</label>
            <input type="number" id="temps" name="temps" value="" placeholder="5"/><span> minutes</span>
        </div>
        <div class="row" style="margin-left: 25%;">
            <a class="bt_form margin_15" href="#" onclick="submite()">Envoyer</a>
            <a class="bt_form margin_15" href="#" onclick="document.getElementById('div_nouveau').style.display='none'">Annuler</a>
        </div>
    </form>
</div>

<script>

function nouveau_devoir(id_groupe){
    document.getElementById("div_nouveau").style.display="initial";
}

function submite(){
    document.getElementById("form_devoir").submit();
}

</script>