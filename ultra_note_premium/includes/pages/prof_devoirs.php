
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

.elt_nv_devoir{
    margin: 15px;
    display: flex;
    flex-direction:row;
}

.selecte1{
    margin: 15px;
    padding: 5px;
}

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


.bt_edit, .bt_delete{
    margin-top:auto;
    margin-bottom:auto;
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


test_compte($bdd, "prof");
$id_prof = $_SESSION["id"];

$groupes = requete($bdd, "SELECT groupes.* FROM groupes INNER JOIN profs_groupes ON groupes.id=id_groupe AND id_prof=".$id_prof);

echo "<script>";
echo "var id_prof=".$id_prof.";";
echo "var devoirs_grps={};";
foreach($groupes as $i=>$data){
   echo "devoirs_grps[".$data["id"]."]=[];";
}

foreach(requete($bdd,"SELECT devoirs.*,matieres.nom,matieres.couleur FROM devoirs INNER JOIN matieres ON id_matiere=matieres.id ORDER BY jour ASC;") as $i=>$data){
    $dev = "{'id':".$data["id"].", 'id_prof':".$data["id_prof"].", 'id_groupe':".$data["id_groupe"].", 'type_':'".$data["type_"]."', 'titre':'".$data["titre"]."', 'description_':'".$data["description_"]."', 'jour':'".$data["jour"]."', 'matiere':'".$data["nom"]."', 'couleur':'".$data["couleur"]."'";
    if($data["temps_evalue"]!=null){
        $dev.=", 'temps_evalue':".$data["temps_evalue"];
    }
    $dev.="}";
    echo "devoirs_grps[".$data["id_groupe"]."].push(".$dev.");";
}
echo "</script>";

?>

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
    var type_=document.getElementById("type_").value;
    var titre=document.getElementById("titre").value;
    var description=document.getElementById("description_").value;
    var jour=document.getElementById("jour").value;
    var mettre_temps=document.getElementById("mettre_temps").checked;
    var temps=document.getElementById("temps").value;
    // on teste
    if(!["exercices", "lecon", "ds", "dm"].includes(type_)){
        alert("Probleme au niveau du type");
        return;
    }
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
    if(mettre_temps){
        if(temps=="" || !isNumeric(temps)){
            alert("Probleme au niveau du temps");
            return ;
        }
    }
    // verifications
    document.getElementById("f_nouveau_devoir").submit();
}

var jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
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
    var devsgrp=devoirs_grps[id_groupe];
    if(devsgrp.length==0){
        document.getElementById("pasdevoirs").style.display="initial";
        document.getElementById("tabledevoirs").style.display="none";
    }
    else{
        document.getElementById("pasdevoirs").style.display="none";
        document.getElementById("tabledevoirs").style.display="initial";
        var ajd=new Date();
        window.prochain_devoir = null;
        for(dev of devsgrp){
            if(dev["id_prof"]==id_prof){
                var drow=document.createElement("tr");
                drow.setAttribute("alt", dev["description_"])
                drow.setAttribute("id", "dev_"+dev["id"])
                var cjour=document.createElement("td");
                var dj = new Date(dev["jour"]);
                if(dj.getTime() <= ajd.getTime()){
                    drow.classList.add("ancient");
                }
                else{
                    drow.classList.add("apres");
                    if(window.prochain_devoir==null){
                        window.prochain_devoir=dev["id"];
                    }
                }
                cjour.innerHTML=jours[dj.getDay()]+" "+dj.getDate()+" "+mois[dj.getMonth()]+" "+(1900+dj.getYear());
                //cjour.innerHTML=dj.toUTCString();
                var cmat=document.createElement("td");
                cmat.innerHTML=dev["matiere"];
                var ctitre=document.createElement("td");
                var rowtitre = document.createElement("div");
                rowtitre.setAttribute("class", "row")
                var titre=document.createElement("b");
                titre.innerHTML=dev["titre"];
                titre.setAttribute("style", "margin-top:auto; margin-bottom:auto;")
                var descr=document.createElement("p");
                //descr.innerHTML="("+dev["description_"]+")";
                descr.innerHTML=dev["description_"];
                descr.setAttribute("class", "descr")
                var bt_edit=document.createElement("button");
                bt_edit.setAttribute("class", "bt_edit");
                bt_edit.setAttribute("onclick", "modif_dev("+dev["id"]+");")
                var bt_delete=document.createElement("button");
                bt_delete.setAttribute("class", "bt_delete");
                bt_delete.setAttribute("onclick", "delete_dev("+dev["id"]+");");
                rowtitre.appendChild(titre);
                rowtitre.appendChild(descr);
                rowtitre.appendChild(bt_edit);
                rowtitre.appendChild(bt_delete);
                ctitre.appendChild(rowtitre);
                drow.appendChild(cjour);
                drow.appendChild(cmat);
                drow.appendChild(ctitre);
                //
                tab.appendChild(drow);
            }
        }
    }
    if(window.prochain_devoir!=null){
        document.getElementById("dev_"+window.prochain_devoir).scrollIntoView();
        document.getElementById('tableau_devoirs').scrollTop-=15;
    }
}

function delete_dev(did){
    document.getElementById("did").value=did;
    document.getElementById("form_delete").submit();
}

function modif_dev(){
    alert("Fonctionnalité pas encore developpée")
}

</script>

<div onload="update_devoirs();">

    <h1>Devoirs par groupe d'eleves :</h1>

    <div class="row">
        <h2>Groupe : </h2>
        <select  class="selecte1" id="select_groupe" onchange="update_devoirs();">
            <?php
foreach(requete($bdd, "SELECT id_groupe, groupes.nom FROM groupes INNER JOIN profs_groupes ON id_groupe=groupes.id AND id_prof=".$id_prof) as $i=>$data){
    echo "<option value='".$data["id_groupe"]."'>".$data["nom"]."</option>";
}
            ?>
        </select>
    </div>

    <div>
        <p id="pasdevoirs">Vous n'avez pas donné de devoirs à ce groupe</p>
        <div class="column" >
            <table id="tabledevoirs">
                <thead>
                    <tr> <th>Jour</th> <th>Matiere</th> <th style="width: 100%;">Devoir</th> </tr>
                </thead>
                <tbody id="tableau_devoirs">

                </tbody>
            </table>
            <button onmouseover="document.getElementById('explics').style.display='initial';" onmouseout="document.getElementById('explics').style.display='none';"  onclick="document.getElementById('div_nouveau').style.display='initial'; document.getElementById('id_groupe').value=document.getElementById('select_groupe').value;" class="bt_1">Nouveau devoir</button>
            <i id="explics" style="font-weight:300; display:none;">(rajoute un devoir au groupe selectionné)</i>
        </div>

    </div>

</div>

<div id="div_nouveau" style="display:none;">
    <form name="nouveau_devoir" id="f_nouveau_devoir" action="includes/pages/nouveau_devoir.php" method="POST">
        <input id="id_groupe" name="id_groupe" value="" style="display:none;" />
        <h1>Nouveau devoir</h1>
        <div class="elt_nv_devoir">
            <label>Type :</label>
            <select id="type_" name="type_">
                <option>exercices</option>
                <option>lecon</option>
                <option>ds</option>
                <option>dm</option>
            </select>
        </div>
        <div class="elt_nv_devoir">
            <label>Matiere :</label>
            <select id="id_matiere" name="id_matiere">
                <?php
foreach(requete($bdd, "SELECT matieres.nom, matieres.id FROM matieres INNER JOIN profs_matieres ON matieres.id=id_matiere AND id_prof=".$id_prof) as $i=>$data){
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
            <input type="date" id="jour" name="jour"/>
        </div>
        <div class="elt_nv_devoir">
            <label>Mettre dans le devoir le temps qu'il demandera (environ)</label>
            <input type="checkbox" name="mettre_temps" id="mettre_temps" value=true onchange="if(document.getElementById('mettre_temps').checked){ document.getElementById('dtemps').style.display='initial'; }else{ document.getElementById('dtemps').style.display='none'; }" />
        </div>
        <div id="dtemps" class="elt_nv_devoir" style="display:none;">
            <label>Temps que le devoir prendra :</label>
            <input type="number" id="temps" name="temps" value="" placeholder="5"/><span> minutes</span>
        </div>
        <div class="row" style="margin-left: 25%;">
            <a class="bt_form margin_15" href="#" onclick="submite()">Envoyer</a>
            <a class="bt_form margin_15" href="#" onclick="document.getElementById('div_nouveau').style.display='none'">Annuler</a>
        </div>
    </form>
</div>
<form style="display:none;" id="form_delete" action="includes/utils/delete_devoir.php" method="POST" ><input id="did" name="did" value="" /></form>
<script>
update_devoirs();
</script>