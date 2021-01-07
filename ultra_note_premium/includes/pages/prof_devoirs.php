<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$id_prof = $_SESSION["id"];

$groupes = requete($bdd, "SELECT groupes.* FROM groupes INNER JOIN profs_groupes ON groupes.id=id_groupe AND id_prof=".$id_prof);

echo "<script>";
echo "var id_prof=".$id_prof.";";
echo "var devoirs_grps={};";
foreach($groupes as $i=>$data){
    echo "devoirs_grps[".$data["id"]."]=[];";
}
foreach(requete($bdd,"SELECT * FROM devoirs INNER JOIN matieres ON id_matiere=matieres.id;") as $i=>$data){
    $dev = "{'id_prof':".$data["id_prof"].", 'id_groupe':".$data["id_groupe"].", 'type_':'".$data["type_"]."', 'titre':'".$data["titre"]."', 'description_':'".$data["description_"]."', 'jour':'".$data["jour"]."', 'temps_evalue':".$data["temps_evalue"].", 'matiere':'".$data["matiere"]."', 'couleur':'".$data["couleur"]."'}";
    echo "devoirs_grps[".$data["id_groupe"]."].push(".$dev.");";
}
echo "</script>";


?>

<script>

function nouveau_devoir(){
    var id_groupe=document.getElementById("select_groupe").value;
    document.getElementById("div_nouveau").style.display="initial";
    document.getElementById("id_groupe").value=id_groupe;
}

function submite(){
    document.getElementById("form_devoir").submit();
}

function update_devoirs(){
    var id_groupe=document.getElementById("select_groupe").value;
    var tab=document.getElementById("tableau_devoirs");
    // On nettoie le tableau
    for(c of tab.children){
        tab.removeChild(c);
    }
    tab.children=[];
    tab.innerHTML="";
    //
    for(di of Object.keys(devoirs_grps)){
        var dev=devoirs_grps[di];
        if(dev["id_prof"]==id_prof && dev["id_groupe"]==id_groupe){
            var drow=document.createElement("tr");
            drow.setAttribute("alt", dev["description_"])
            var cmat=document.createElement("td");
            cmat.innerHTML=dev["matiere"];
            var ctitre=document.createElement("td");
            var titre=document.createElement("h2");
            titre.innerHTML=dev["titre"];
            var bt_edit=document.createElement("button");
            bt_edit.setAttribute("class", "bt_edit");
            bt_edit.onclick="";
            var bt_delete=document.createElement("button");
            bt_delete.setAttribute("class", "bt_delete");
            bt_delete.onclick="";
            //
        }
    }
}

</script>
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

.selecte1{
    border-radius: 10px;
    font-size: 1.2em;
    decoration: none;
    border: none;
}

</style>

<div>

<h1>Devoirs par groupe d'eleves :</h1>

<div>

<div class="selecte1">
    <select id="select_groupe" onchange="update_devoirs();">
        <?php
foreach(requete($bdd, "SELECT id_groupe, groupes.nom FROM groupes INNER JOIN profs_groupes ON id_groupe=groupes.id AND id_prof=".$id_prof) as $i=>$data){
    echo "<option value='".$data["id_groupe"]."'>".$data["nom"]."</option>";
}
        ?>
    </select>
</div>

<div class="column">
    <table id="tableau_devoirs">

    </table>
    
    <button onclick="nouveau_devoir()" class="bt_1">Nouveau devoir</button>
</div>

</div>

</div>

<div id="div_nouveau" style="display:none;">
    <form name="nouveau_devoir" id="f_nouveau_devoir" action="nouveau_devoir.php" method="POST">
        <input id="id_groupe" name="id_groupe" value="" style="display:none;" />
        <h1>Nouveau devoir</h1>
        <div class="elt_nv_devoir">
            <label>Matiere :</label>
            <select id="id_matiere" name="id_matiere" onchange="update_devoirs();">
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
