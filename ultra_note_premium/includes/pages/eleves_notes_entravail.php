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

test_compte($bdd, "eleve");

/*
On teste si le compte qui accede a cette page a bien les permissions pour y acceder,
cela évite un tres gros trou de sécurité
*/
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

foreach($matieres as $i=>$data){
    echo "notes_matiere[".$data["id"]."]=[];";
}
$requested="SELECT * FROM notes";
foreach(requete($bdd, $requested) as $i=>$data){
    $note="{'id': ".$data["id"]."}";
    echo "notes_matieres[".$data["id_matiere"]."].push(".$note.");";
}

?>
</script>
<div>

<div class="row">

    <div>
        <p id="pasdenotes">Vous n'avez pas donné de notes</p>
        <table id="tableau_notes">
            <thead>
                <th>Notes</th>
           </thead>

           <tbody id="tableau_note">

           </tbody>
        </table>
    </div>

</div>