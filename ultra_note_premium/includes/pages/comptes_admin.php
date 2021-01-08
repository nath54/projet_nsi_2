


<script>
var datas_account={};
var eleves_classes={}; // key = id_eleve, value = id_classe
var eleves_groupes={}; // key = id_eleve, value = id_groupe
</script>
<?php

include_once(".../init.php");
include_once("../bdd.php");

$bdd=load_db("../");

test_admin($bdd);

$_SESSION["id_compte_modif"]=null;

$mon_compte = requete($bdd, "SELECT * FROM comptes WHERE id=".$_SESSION["id"])[0];

// On récupère sous la forme d'un dictionnaire pour chaque classe quels eleves il y a dedans
foreach(requete($bdd, "SELECT id FROM classes WHERE id_etablissement=".$mon_compte["id_etablissement"].";") as $k=>$data){
    echo "<script>eleves_classes[".$data["id"]."]=[]</script>";
}
foreach(requete($bdd, "SELECT id_eleve, id_classe FROM eleves_classes INNER JOIN classes ON id_classe=classes.id WHERE id_etablissement=".$mon_compte["id_etablissement"].";") as $k=>$data){
    echo "<script>eleves_classes[".$data["id_classe"]."].push(".$data["id_eleve"].");</script>";
}

// On récupère sous la forme d'un dictionnaire pour chaque groupe quels eleves il y a dedans
foreach(requete($bdd, "SELECT id FROM groupes;") as $k=>$data){
    echo "<script>eleves_groupes[".$data["id"]."]=[]</script>";
}
foreach(requete($bdd, "SELECT id_eleve, id_groupe FROM eleves_groupes INNER JOIN groupes ON id_groupe=groupes.id WHERE id_etablissement=id_etablissement=".$mon_compte["id_etablissement"].";") as $k=>$data){
    echo "<script>eleves_groupes[".$data["id_groupe"]."].push(".$data["id_eleve"].");</script>";
}

?>

<div class="row_wrap" id="filtres_comptes">
    <h2 class="margin_15 margin_v_auto">Filtrer </h2>
    <div class="margin_15 margin_v_auto">
        <label>Trier par type :</label>
        <select id="f_type" onchange="update_filtres();">
            <option>tout</option>
            <option>eleve</option>
            <option>prof</option>
            <option>admin</option>
            <option>parent</option>
        </select>
    </div>
    <div class="f_eleve margin_15 margin_v_auto">
        <label>Trier par classe/groupes :</label>
        <select id="f_classe_grp" onchange="update_filtres();">
            <option>tout</option>
            <?php
            foreach(requete($bdd, "SELECT id, nom FROM classes;") as $i=>$data){
                echo "<option value='c_".$data["id"]."'>CLASSE : ".$data["nom"]."</option>";
            }
            foreach(requete($bdd, "SELECT id, nom FROM groupes;") as $i=>$data){
                echo "<option value='g_".$data["id"]."'>GROUPE : ".$data["nom"]."</option>";
            }
            ?>
        </select>
    </div>
    <div class="f_eleve margin_15 margin_v_auto">
        <label>Rechercher : </label>
        <input type="text" id="input_search" onchange="update_filtres();"/>
    </div>
</div>

<div class="row_wrap">

<?php

// normalement, la variable $bdd contient l'objet connecté a la base de donnée, car initialisée
// au début de la création de la page

$accounts = requete($bdd, "SELECT * FROM comptes WHERE id_etablissement=".$mon_compte["id_etablissement"].";");

foreach($accounts as $i=>$data){
    $td = "<div class='div_compte' id=".$data["id"].">";
    $td .= "<h1>".$data["nom"]." ".$data["prenom"]."</h1>";
    $td .= "<p>".$data["type_"]."</p>";
    if($data["id"]!=$_SESSION["id"]){
        $td .= "<div class='row_wrap row_bt'> <button class='bt_edit' onclick='modify_account(".$data["id"].")'></button> <button class='bt_delete' onclick='delete_account(".$data["id"].")'></button> </div>";
    }
    $td .= "</div>";
    echo $td;
    $ts = "<script>datas_account[".$data["id"]."]={";
    foreach($data as $k=>$v){
        if(gettype($v) == "string"){
            $ts .= "'".$k."':'".$v."',";
        }
        else if(in_array(gettype($v), ["float", "real", "integer"])){
            $ts .= "'".$k."':".$v.",";
        }
    }
    $ts = substr($ts, 0, -1);
    $ts .= "}</script>";
    echo $ts;
}

?>

<div id="compte_plus" class="div_compte" onclick="change_page('create_compte');">
    <h1>+</h1>
</div>

</div>
<script>

function update_filtres(){
    var ftype = document.getElementById("f_type").value;
    var rech = document.getElementById("input_search").value;
    //
    var cg = document.getElementById("f_classe_grp").value;
    var els_id=null;
    var cl = cg.split("_");
    if(cl.length==2){
        var tc = cl[0];
        var ic = cl[1];
        if(tc=="c"){
            els_id = eleves_classes[ic];
        }
        else if(tc=="g"){
            els_id = eleves_groupes[ic];
        }
    }
    //
    for(i of Object.keys(datas_account)){
        var data = datas_account[i];
        var d=document.getElementById(data["id"]);
        //
        d.style.display = "initial";
        // type
        if(ftype!="tout" && data["type_"]!=ftype){ d.style.display = "none"; }
        // classe / groupe
        if(els_id!=null){
            var is_in = false;
            for(ide of els_id){
                if(ide == data["id"]){
                    is_in = true;
                    break;
                }
            }
            //
            if(! is_in ){
                d.style.display = "none";
            }
        }
        // recherche
        if(rech!=""){
            if( !data["pseudo"].includes(rech) &&
                !(data["nom"]+" "+data["prenom"]).includes(rech) &&
                !(data["prenom"]+" "+data["nom"]).includes(rech) ){
                d.style.display = "none";
            }
        }
    }
}

</script>