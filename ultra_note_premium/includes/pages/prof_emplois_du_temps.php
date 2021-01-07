<style>

.jour{
    width: 25em;
    background-color: rgb(100,100,100);
    height: 440px;
    width: 180px;
}

table, th, td{
    border: 1px solid black;
    border-collapse: collapse;
}
table{
    margin: 10px;
}
th{
    background-color: rgb(60, 60, 60);
    padding: 5px;
}

#heures{
    width: 100%;
    height: 100%;
    border: none;
    position: sticky;
    top: -8px;
}
.theure{
    position: sticky;
    font-size: 16px;
}
/*
On commence a 8h15 : top 0
et on fini a 19h15 : bottom 0
la div jour fait 440px de hauteur
on a 11 heures a afficher => 40 px de hauteur par heure
*/
#h8-15{
    top: 0px;
}
#h10-10{
    top: 77px;
}
#h12-15{
    top: 160px;
}
#h14-10{
    top: 237px;
}
#h16-10{
    top: 317px;
}
#h18-15{
    top: 400px;
}

.divcour{
    border: none;
    text-align: center;
    display: flex;
    flex-direction: column;
}

</style>
<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$id_prof = $_SESSION["id"];


?>
<script>

window.jour_actu=new Date();
// on veut récupérer le lundi de la semaine actuelle
window.jour_actu.setDate(window.jour_actu.getDate() - (window.jour_actu.getDay()-1));
alert(window.jour_actu.toUTCString());

var jours_travail=["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
var cours=[];

<?php
$requette="SELECT cours.*, matieres.nom, matieres.couleur FROM cours INNER JOIN matieres ON id_matiere=matieres.id WHERE id_prof=".$id_prof;
foreach(requete($bdd, $requette) as $i=>$data){
    echo "cours.push({'id': ".$data["id"].",'id_matiere': ".$data["id_matiere"].",'id_groupe': ".$data["id_groupe"].",'jour': '".$data["jour"]."','heure_debut': ".$data["heure_fin"].",'heure_fin': ".$data["heure_debut"].",'semaine': ".$data["semaine"]."});";
}
?>

</script>
<div onload="update_edt();">
    <div class="row" style="text-align:center; margin-left:auto; margin-right:auto;">
        <button onclick="sem_avant();"><</button>
        <div>Semaine du <span id="j1"></span> au <span id="j2"></span></div>
        <button onclick="sem_apres();">></button>
    </div>
    <div id="emplois_du_temps">
        <table>
            <tr>
                <th>Heure :</th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
            </tr>
            <tr>
                <td class="column" id="heures">
                    <span id="h8-15" class="theure">8h15</span>
                    <span id="h10-10" class="theure">10h10</span>
                    <span id="h12-15" class="theure">12h15</span>
                    <span id="h14-10" class="theure">14h10</span>
                    <span id="h16-10" class="theure">16h10</span>
                    <span id="h18-15" class="theure">18h15</span>
                </td>
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
<script>

function sem_avant(){
    window.jour_actu.setDate(window.jour_actu.getDate()-7);
}

function sem_apres(){
    window.jour_actu.setDate(window.jour_actu.getDate()+7);
}

function update_edt(){
    // on recupere le jour du debut
    var jdb = window.jour_debut;
    // on nettoie
    for(idj of jours_travail){
        var j=document.getElementById(idj);
        for(c of j.children){
            j.removeChild(c);
        }
        j.children=[];
        j.innerHTML="";
    }
    // on parcours les cours du prof, et si ils sont dans la semaine actuelle, on les affiches
    var i=0;
    for(c of cours){
        // on regarde le jour et on teste s'il est dans la semaine actuelle
        var cj=new Date(c["jour"]);
        var dist = cj.getDate()-window.jour_actu.getDate();
        if(!(dist>=0 && dist<=6)){ continue; }
        // on crée la div cour
        var divcour=document.createElement("div");
        divcour.setAttribute("id", "d_"+i);
        divcour.style.background_color = c["couleur"];
        divcour.classList.add("divcour");
        var matiere=document.createElement("b");
        var groupe=document.createElement("p");
        var salle=document.createElement("p");
        divcour.appendChild(matiere);
        divcour.appendChild(groupe);
        divcour.appendChild(salle);
        document.getElementById(jours_travail[cj.getDay()]).appendChild(divcour);
        //
        var divcour=document.getElementById("d_"+i);
        divcour.style.top=0;
        var hd=c["heure_debut"];
        var hdh=parseInt(hd);
        var hdm=hd-hdh*100;
        var hf=c["heure_debut"];
        var hfh=parseInt(hf);
        var hfm=hf-hfh;
        // l'heure ne peut pas commencer avant 8h et apres 19h
        var y=(hdh-8)*40;
        y+=parseInt(hdm/60*40);
        var dh=hfh-hdh;
        var dm=hfm-hdm;
        if(dm<0){
            dh-=1;
            dm=60+dm;
        }
        //
        var t=40*dh;
        t+=parseInt(m/60*40);
        //
        i++;
    }
}

</script>