<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");

test_admin();

$mon_compte = requete($bdd, "SELECT * FROM comptes WHERE id=".$_SESSION["id"])[0];
?>
<script>

var groupes={};

<?php
foreach(requete($bdd, "SELECT id, nom FROM groupes WHERE id_etablissement=".$mon_compte["id_etablissement"].";") as $i=>$data){
    echo "groupes[".$data["id"]."]={'nom': '".$data["nom"]."', 'eleves':[] };";
}

foreach(requete($bdd, "SELECT id_groupe, id_eleve FROM eleves_groupes INNER JOIN groupes ON id_groupe=groupes.id WHERE id_etablissement=".$mon_compte["id_etablissement"].";") as $i=>$data){
    echo "groupes[".$data["id_groupe"]."]['eleves'].push(".$data["id_eleve"].");";
}

?>

</script>
<div>
    <!-- gestion groupes -->
    <div>
        <h1>Groupes :</h1>
        <div class="row">
            <div id="div_groups" class="row">
            </div>
            <div id="group_plus" class="div_compte" onclick="change_page('create_group');">
                <h1>+</h1>
            </div>
        </div>
    </div>

</div>
<script>

function create_group(gid){
    var dg=document.createElement("div");
    dg.setAttribute("class", "div_compte");
    dg.id="g_"+gid;
    var nom=document.createElement("h2");
    nom.innerHTML=groupes[gid]["nom"];
    var modifier=document.createElement("button");
    modifier.innerHTML="modifier";
    modifier.setAttribute("onclick", "change_page('modify_group', bt_actif=null, arguments='gid="+gid+"');");
    dg.appendChild(nom);
    dg.appendChild(modifier);
    document.getElementById("div_groups").appendChild(dg);
}

for(group of Object.keys(groupes)){
    create_group(group);
}

</script>