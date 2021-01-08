<style>

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
    max-height: 150px;
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

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once("$root/projet_nsi_2/ultra_note_premium/includes/init.php");
include_once("$root/includes/bdd.php");

$bdd = load_db("../");
test_eleve($bdd);
$id_eleve = $_SESSION["id"];

?>
<script>

var devoirs=[];

<?php

echo "var id_eleve=".$id_eleve.";";

$requested = "SELECT devoirs.*, matieres.nom FROM devoirs INNER JOIN matieres ON devoirs.id_matiere=matieres.id INNER JOIN groupes ON devoirs.id_groupe=groupes.id INNER JOIN eleves_groupes ON eleves_groupes.id_groupe=groupes.id AND eleves_groupes.id_eleve=".$id_eleve." ORDER BY jour ASC";
// echo "</script>".$requested."<script>";
foreach(requete($bdd, $requested) as $i=>$data){
    // echo "</script>".aff_array($data, false)."<script>";
    $dev="{'id': ".$data["id"].", 'jour': '".$data["jour"]."', 'nom': '".$data["nom"]."', 'titre': '".$data["titre"]."', 'description_': '".$data["description_"]."', 'nom': '".$data["nom"]."'}";
    $txt= "devoirs.push(".$dev.");";
    echo $txt;
}

?>


var jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
function update_devoirs(){
    var tab=document.getElementById("tableau_devoirs");
    // On nettoie le tableau
    for(c of tab.children){
        tab.removeChild(c);
    }
    tab.children=[];
    tab.innerHTML="";
    //
    if(devoirs.length==0){
        document.getElementById("pasdevoirs").style.display="initial";
        document.getElementById("tabledevoirs").style.display="none";
    }
    else{
        document.getElementById("pasdevoirs").style.display="none";
        document.getElementById("tabledevoirs").style.display="initial";
        var ajd=new Date();
        window.prochain_devoir = null;
        for(dev of devoirs){
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
            cmat.innerHTML=dev["nom"];
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
            rowtitre.appendChild(titre);
            rowtitre.appendChild(descr);
            ctitre.appendChild(rowtitre);
            drow.appendChild(cjour);
            drow.appendChild(cmat);
            drow.appendChild(ctitre);
            //
            tab.appendChild(drow);
        }
    }
    if(window.prochain_devoir!=null){
        document.getElementById("dev_"+window.prochain_devoir).scrollIntoView();
        document.getElementById('tableau_devoirs').scrollTop-=15;
    }
}


</script>

<div onload="update_devoirs();">

    <p id="pasdevoirs" style="display:none;">Vous n'avez apparament pas de devoirs</p>
    <table id="tabledevoirs">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Matiere</th>
                <th>Devoir</th>
            </tr>
        </thead>
        <tbody id="tableau_devoirs">
            
        </tbody>
    </table>

</div>
<script>
update_devoirs();
</script>