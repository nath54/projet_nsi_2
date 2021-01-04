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
foreach(requete($bdd, "SELECT * FROM comptes WHERE type_='eleve';") as $i=>$data){
    echo "eleves[".$data["id"]."]='".$data["nom"]." ".$data["prenom"]."';";
}
echo "var eleves_groupe=[];";
foreach(requete($bdd, "SELECT * FROM eleves_groupes WHERE id_groupe=".$_GET["gid"]) as $i=>$data){
    echo "eleves_groupe.push(".$data["id_eleve"].");";
}

?>

</script>
<form id="form_group" name="form_group" method="POST" action="modify_group2.php">
    <input id="eleves" name="eleves" style="display:none;" value=""/>
    <div id="eleves">

    </div>
    <div class="">
        <select class="margin_15" id="select_eleves"></select>
        <a class="bt_form" href="#" onclick="ajouter();">Ajouter</a>
    </div>
<a class="bt_form margin_15" href="#" onclick="">Ok</a>
</form>
<script>

function update(){
    var dsel=document.getElementById("select_eleves");
    var deleves=document.getElementById("eleves");
    //
    for(c of dsel.children){
        dsel.removeChild(c);
    }
    dsel.children=[];
    dsel.innerHTML="";
    for(ide of Object.keys(eleves)){
        if(!eleves_groupe.includes(ide)){
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
    console.log(eleves_groupe);
    for(ide of eleves_groupe){
        var d=document.createElement("div");
        var t=document.createElement("h2");
        t.innerHTML=eleves[ide];
        var bt_del=document.createElement("a");
        bt_del.setAttribute("class","bt_delete");
        bt_del.setAttribute("href", "#");
        bt_del.setAttribute("onclick=delete("+ide+");");
        d.appendChild(t);
        d.appendChild(bt_del);
        deleves.appendChild(d);
    }
}

function ajouter(){
    var ide=document.getElementById("select_eleves").value;
    eleves_groupe.push(ide);
    update();
}
function delete(ide){
 //   eleves_groupe = eleves_groupe.filter(item => item !== ide);
}


update();

</script>
