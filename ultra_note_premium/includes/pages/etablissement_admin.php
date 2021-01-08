<?php

/*
Ici, on va faire un include sur le fichier `init.php`,
qui chargera la session ainsi que quelques petites fonctons en php,
On va aussi inclure le fichier `bdd.php`, 
qui nous permet de récupérer la base de donnée (fonction load_db),
et qui fourni aussi quelques fonctions utiles pour l'interaction avec la base de donnée,
les plus utilisées sont `requete()` et `action()`,
qui servent respectivement à récuperer des tableaux et à faire des modifications à la base de donnée.

J'ai du mettre sous cette forme à cause d'un probleme de chemins pour acceder au fichiers, 
du a l'arborescence de fichiers du projets, qui commence a etre certe sophistiquée,
mais aussi surtout bien utile lorsqu'il s'agit de s'organiser
*/
$pathe=explode(DIRECTORY_SEPARATOR,getcwd());
$laste=$pathe[count($pathe)-1];
if($laste=="pages"){
    include_once("../init.php");
    include_once("../bdd.php");
    $bdd=load_db("../");
}
else if($laste=="includes"){
    include_once("init.php");
    include_once("bdd.php");
    $bdd=load_db("");
}
else if($laste=="ultra_note_premium"){
    include_once("includes/init.php");
    include_once("includes/bdd.php");
    $bdd=load_db("includes/");
}

test_compte($bdd, "admin");

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