<?php

include_once "../init.php";
include_once "../bdd.php";

$bdd = load_db("../");


// aff_array($_GET);
echo "<script>var id_groupe=".$_GET["gid"].";</script>";
echo "<script>var eleves={};</script>"
?>
<script>

<?php

echo "var id_groupe=".$_GET["gid"].";";
echo "var eleves={};";
$niveau_groupe=requete($bdd, "SELECT niveau FROM groupes WHERE id=".$_GET["gid"])[0]["niveau"];
$requested="SELECT comptes.* FROM comptes INNER JOIN eleves_classes ON comptes.id=id_eleve INNER JOIN classes ON classes.id=id_classe WHERE type_='eleve' AND niveau='".$niveau_groupe."';";
// echo "</script>".$requested."<script>";
$eleves = requete($bdd, $requested);
// echo "</script>".aff_array($eleves, false)."<script>";
foreach($eleves as $i=>$data){
    echo "eleves[".$data["id"]."]='".$data["nom"]." ".$data["prenom"]."';";
}
echo "var eleves_groupe=[];";
foreach(requete($bdd, "SELECT * FROM eleves_groupes WHERE id_groupe=".$_GET["gid"]) as $i=>$data){
    echo "eleves_groupe.push(".$data["id_eleve"].");";
}

?>

</script>
<form id="form_group" name="form_group" method="POST" action="includes/pages/modify_group2.php">
    <input name="action" value="modif" />
    <input id="eleves_groups" name="eleves_groups" style="display:none;" value=""/>
    <input id="id_groupe" name="id_groupe" style="display:none;" value=""/>
    <div id="eleves">

    </div>
    <div class="">
        <select class="margin_15" id="select_eleves"></select>
        <a class="bt_form" href="#" onclick="ajouter_groups();">Ajouter</a>
    </div>
    <div class="row">
        <a class="bt_form margin_15" href="#" onclick="submit_groups();">Ok</a>
        <a class="bt_form margin_15" href="#" onclick="delete_group();">Supprimer le groupe</a>lass="row">
    </div>
</form>
<script>

function update_groups(){
    var dsel=document.getElementById("select_eleves");
    var deleves=document.getElementById("eleves");
    //
    for(c of dsel.children){
        dsel.removeChild(c);
    }
    dsel.children=[];
    dsel.innerHTML="";
    for(ide of Object.keys(eleves)){
        if(!eleves_groupe.includes(parseInt(ide))){
            var o = document.createElement("option");
            o.setAttribute("value", ide);
            o.innerHTML=eleves[ide];
            dsel.appendChild(o);
        }
    }
    //
    for(c of deleves.children){
        deleves.removeChild(c);
    }
    deleves.children=[];
    deleves.innerHTML="";
    if(eleves_groupe.length==0){
        var p = document.createElement("p");
        p.innerHTML = "Il n'y a pas d'éleves dans ce groupe"
        deleves.appendChild(p);
    }
    else{
        var t = document.createElement("h1");
        t.innerHTML = "Eleves du groupe : "
        deleves.appendChild(t);
        for(ide of eleves_groupe){
            var d=document.createElement("div");
            d.setAttribute("class","row row_grp")
            var t=document.createElement("h2");
            t.innerHTML=eleves[ide];
            var bt_del=document.createElement("img");
            bt_del.setAttribute("class","bt_delete");
            bt_del.setAttribute("href", "#");
            bt_del.setAttribute("style", "margin: auto; margin-right:5px;");
            bt_del.setAttribute("onclick","delete_eleve("+ide+");");
            d.appendChild(t);
            d.appendChild(bt_del);
            deleves.appendChild(d);
        }
    }
}

function ajouter_groups(){
    var ide=document.getElementById("select_eleves").value;
    eleves_groupe.push(parseInt(ide));
    update_groups();
}
function delete_eleve(ide){
    eleves_groupe = eleves_groupe.filter(item => item !== ide);
    update_groups();
}

function submit_groups(){
    document.getElementById("eleves_groups").value=eleves_groupe.join("|");
    document.getElementById("id_groupe").value=id_groupe;
    document.getElementById("form_group").submit();
}

function delete_group(){
    document.getElementById("action").value="delete";
    document.getElementById("id_groupe").value=id_groupe;
    document.getElementById("form_group").submit();
}

update_groups();

</script>
