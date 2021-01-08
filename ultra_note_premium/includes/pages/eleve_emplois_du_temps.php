<style>

.jour{
    width: 25em;
    background-color: rgb(100,100,100);
    height: 440px;
    overflow: none;
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
}
.theure{
    margin: 0;
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
    margin: 0;
    text-align: center;
    display: flex;
    flex-direction: column;
    position: sticky;
    width: 100%;
    font-size: 0.8em;
    overflow: hidden;
}

</style>
<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$id_eleve = $_SESSION["id"];


?>
<script>

window.jour_actu=new Date();
// on veut récupérer le lundi de la semaine actuelle
window.jour_actu.setDate(window.jour_actu.getDate() - (window.jour_actu.getDay()-1));

var jours_travail=["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
var cours=[];

<?php
$requette="SELECT cours.*, matieres.nom AS matnom, prof.nom AS profnom, matieres.couleur AS couleur FROM cours INNER JOIN matieres ON id_matiere=matieres.id INNER JOIN comptes AS prof ON id_prof=prof.id INNER JOIN eleves_groupes ON cours.id_groupe=eleves_groupes.id_groupe AND eleves_groupes.id_eleve=".$id_eleve;
foreach(requete($bdd, $requette) as $i=>$data){
    echo "cours.push({'id': ".$data["id"].",'id_matiere': ".$data["id_matiere"].",'id_groupe': ".$data["id_groupe"].",'jour': '".$data["jour"]."','heure_debut': ".$data["heure_debut"].",'heure_fin': ".$data["heure_fin"].",'semaine': ".$data["semaine"].", 'salle': '".$data["salle"]."', 'profnom': '".$data["profnom"]."', 'matnom': '".$data["matnom"]."', 'couleur': '".$data["couleur"]."'});";
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
                <th style="border-bottom:none; background-color: rgb(40,40,40); width:70px;"></th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
            </tr>
            <tr>
                <td class="column" id="heures">
                    <span id="h8-15" class="theure">8h15-</span>
                    <span id="h10-10" class="theure">10h10-</span>
                    <span id="h12-15" class="theure">12h15-</span>
                    <span id="h14-10" class="theure">14h10-</span>
                    <span id="h16-10" class="theure">16h10-</span>
                    <span id="h18-15" class="theure">18h15-</span>
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
    update_edt();
}

function sem_apres(){
    window.jour_actu.setDate(window.jour_actu.getDate()+7);
    update_edt();
}

function update_edt(){
    // on recupere le jour du debut
    var jdb = window.jour_actu;
    // on affiche quelle semaine on va traiter
    var jf = new Date();
    jf.setDate(jdb.getDate()+7);
    document.getElementById("j1").innerHTML=""+jdb.getDate()+" "+mois[jdb.getMonth()];
    document.getElementById("j2").innerHTML=""+jf.getDate()+" "+mois[jf.getMonth()];
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
        // on regarde si notre semaine est en semaine A ou B
        // et si il n'est en bonne semaine, bah on skip ce cours
        if(false){
            continue;
        }
        // on crée la div cour
        var divcour=document.createElement("div");
        divcour.setAttribute("id", "d_"+i);
        divcour.style.backgroundColor = c["couleur"];
        divcour.classList.add("divcour");
        var matiere=document.createElement("b");
        matiere.innerHTML=c["matnom"];
        matiere.style.margin="0px";
        var infos=document.createElement("div");
        infos.classList.add("row");
        var prof=document.createElement("p");
        prof.innerHTML=c["profnom"];
        prof.style.margin="0px";
        prof.style.marginLeft="5px";
        var salle=document.createElement("p");
        salle.style.margin="0px";
        salle.style.marginLeft="5px";
        salle.innerHTML=c["salle"];
        divcour.appendChild(matiere);
        divcour.appendChild(infos);
        infos.appendChild(prof)
        infos.appendChild(salle);
        var jj = c["jour"]-1;
        var divjour=document.getElementById(jours_travail[jj])
        divjour.appendChild(divcour);
        //
        var divcour=document.getElementById("d_"+i);
        divcour.style.top=0;
        var hd=c["heure_debut"];
        var hdh=parseInt(hd);
        var hdm=(hd-0.15-hdh)*10.;
        var hf=c["heure_fin"];
        var hfh=parseInt(hf);
        var hfm=(hf-0.15-hfh)*10.;
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
        t+=parseInt(dm/60*40);
        //
        divcour.style.position="absolute";
        var tope=divjour.offsetTop+y+122;
        var lefte=divjour.offsetLeft+39;
        divcour.style.width=""+divjour.offsetWidth+"px";
        divcour.style.height=""+t+"px";
        divcour.style.left=""+lefte+"px";
        //divcour.style.right=""+(divjour.offsetLeft+divjour.offsetWidth)+"px";
        divcour.style.top=""+tope+"px";
        // divcour.style.bottom=""+(divjour.offsetTop+y+t)+"px";
        //
        i++;
    }
    // on va aussi réactualiser l'affichage des heures
    var hhh=document.getElementById("heures");
    for(hh of [["h8-15", 0],["h10-10", 77], ["h12-15", 160], ["h14-10", 237], ["h16-10", 317], ["h18-15", 399]]){
        var h=document.getElementById(hh[0]);
        h.style.position="absolute";
        h.style.top=""+(hhh.offsetTop+hh[1]+111-8)+"px";
    }
}
update_edt();
document.body.onresize=update_edt;
</script>