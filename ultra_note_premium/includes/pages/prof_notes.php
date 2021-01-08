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
    max-width: 600px;
    overflow-y: scroll;
}

.elt_nv{
    margin: 15px;
    display: flex;
    flex-direction:row;
}

</style>
<script>document.body.onresize=null;</script>
<?php

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


test_prof($bdd);

$id_prof = $_SESSION["id"];
$mats = requete($bdd,"SELECT * FROM matieres");
$notes = requete($bdd,"SELECT * FROM notes");
$groupes=requete($bdd, "SELECT * FROM groupes");

$matieres=array();
foreach($mats as $i=>$data){
    $matieres[$data["id"]]=$data["nom"];
}

?>
<script>
<?php
echo "var notes_groupes={};";

foreach($groupes as $i=>$data){
    echo "notes_groupes[".$data["id"]."]=[];";
}
$requested="SELECT * FROM notes WHERE notes.id_prof=".$id_prof;
echo "</script>".$requested."<script>";
foreach(requete($bdd, $requested) as $i=>$data){
    $note="{'id': ".$data["id"].", 'id_matiere': ".$data["id_matiere"];
    $note.=", 'id_groupe': ".$data["id_groupe"]."}";
    echo "notes_matieres.push(".$note.");";
}

?>
</script>
<div>

    <div class="row">
        <h2>Groupe : </h2>
        <select  class="selecte1" id="select_groupes" onchange="update_notes();">
            <?php
foreach(requete($bdd, "SELECT id_groupe, groupes.nom FROM groupes INNER JOIN profs_groupes ON id_groupe=groupes.id AND id_prof=".$id_prof) as $i=>$data){
    echo "<option value='".$data["id_groupe"]."'>".$data["nom"]."</option>";
}
            ?>
        </select>
        
        <h2>Trimestre : </h2>
        <select  class="selecte1" id="select_trimestre" onchange="update_notes();">
            <option value=0>tout</option>
            <option value=1>trimestre 1</option>
            <option value=2>trimestre 2</option>
            <option value=3>trimestre 3</option>
        </select>
    </div>

    <div>
        <table>
            <thead>
                <tr></tr>
           </thead>
            
           <tbody id="tableau_notes">
                
           </tbody>
        </table>
        <button class="bt_form" onclick="document.getElementById('div_nouveau').style.display='initial'">Nouvelles Notes</button>
    </div>

</div>

<div id="div_nouveau" style="display:none;">
    <form id="forme" method="POST" action="includes/utils/nouvelle_note.php">
        <h1>Nouvelle Note :</h1>
        <div class="elt_nv">
            <label>Nom du DS/DM/... :</label>
            <input type="text" name="nom" id="nom" value="" placeholeder="ex : DS sur les probas" />
        </div>
        <div class="elt_nv">
            <label>Description du DS/DM/... :</label>
            <input type="text" name="description_" id="description_" value="" placeholeder="ex : arbres pondérés, sacs de boules, ..." />
        </div>
        <div class="elt_nv">
            <label>Matiere :</label>
            <select id="id_matiere" name="id_matiere">
                <?php
foreach(requete($bdd, "SELECT matieres.nom, matieres.id FROM matieres INNER JOIN profs_matieres ON matieres.id=id_matiere AND id_prof=".$id_prof) as $i=>$data){
    echo "<option value=".$data["id"].">".$data["nom"]."</option>";
}
                ?>
            </select>
        </div>
        <div class="elt_nv">
            <label>Coef :</label>
            <input type="text" name="coef" id="coef" value="" placeholeder="1.0" />
        </div>
        <div class="elt_nv">
            <label>jour :</label>
            <input type="date" id="jour" name="jour"/>
        </div>
        <div class="elt_nv">
            <label>jour où les élèves peuvent voir :</label>
            <input type="date" id="jour_visible" name="jour_visible"/>
        </div>
        <div class="row" style="margin-left: 25%;">
            <a class="bt_form margin_15" href="#" onclick="submite()">Envoyer</a>
            <a class="bt_form margin_15" href="#" onclick="document.getElementById('div_nouveau').style.display='none'">Annuler</a>
        </div>
    </form>
</div>

<script>


var characteres_autorises_texts = [
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r",
    "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
    "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1",
    "2", "3", "4", "5", "6", "7", "8", "9", "é", "à", "è", "ç", "ù", "ï", "-", "_", "&", "*",
    "."," ",",",";",":", "?"
];

function submite(){
    // tests
    // on récupere les valeurs
    var idg=document.getElementById("id_groupe").value;
    var titre=document.getElementById("titre").value;
    var description=document.getElementById("description_").value;
    var jour=document.getElementById("jour").value;
    var jour_visible=document.getElementById("jour_visible").value;
    var coef=document.getElementById("coef").value;
    // on teste
    if(idg=="" || !isNumeric(idg)){
        alert("Probleme d'identifiant du groupe");
        return;
    }
    if(titre.length<4){
        alert("Le titre doit etre plus grand que 4");
        return;
    }
    for(str of [titre, description]){
        for(c of str){
            if(!characteres_autorises_texts.includes(c)){
                alert("Charactere non autorisé dans le titre ou la description : '"+c+"'");
                return;
            }
        }
    }
    if(jour.length<6 || !isDateValid(jour)){
        alert("Probleme au niveau du format la date");
        return ;
    }
    if(jour_visible.length<6 || !isDateValid(jour_visible)){
        alert("Probleme au niveau du format la date visible");
        return ;
    }
    //
    document.getElementById("forme").submit();
}

function update_notes(){
    var idg = document.getElementById("select_groupes").value;
    var trimestre = document.getElementById("select_trimestre").value;
    var tab=document.getElementById("tableau_notes");
    // On nettoie
    for(c of tab.children){
        tab.removeChild(c);
    }
    tab.innerHTML="";
    tab.children=[];
    var bnotes = [];
    // On trie les notes
    for(not of notes){
        // Si ce n'est pas le bon groupe
        if(not["id_groupe"]!=idg){
            continue;
        }
        // Si ce n'est pas le bon trimestre
        var j = new Date(not["jour"]);
        var tri = parseInt((j.getMonth() + 2) / 3); // formule récupérée sur internet
        if(trimestre!=0 && tri!=trimestre){
            continue
        }
        //
        bnotes.push(not);
    }
    // On rajoutes les notes dans le tableau s'il y en a, sinon, on affiche un message
    if(bnotes.length>0){
        for(not of bnotes){
            var drow = document.createElement("tr");
            var titre = document.createElement("h1");
            titre.innerHTML = not["titre"];
            var descr = document.createElement("p");
            descr.innerHTML = not["description_"];
            var bt_modif = document.createElement("button");
            bt_modif.classList.add("bt_edit");
            //
        }
    }
    else{

    }
}

</script>