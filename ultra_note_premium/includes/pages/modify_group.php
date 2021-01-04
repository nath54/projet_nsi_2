<?php

include_once "../init.php";
include_once "../bdd.php";

echo "<script>var id_groupe=".$_GET["gid"].";</script>";
echo "<script>var eleves=</script>"

?>
<script>

<?php

echo "var id_groupe=".$_GET["gid"].";";
echo "var eleves={};";
foreach(requete($bdd, "SELECT * FROM comptes WHERE type_='eleve';") as $i=>$data){
    echo "eleves[".$data["id"]."]=".$data["nom"]." ".$data["prenom"]."';";
}
echo "var eleves_groupe=[];";
foreach(requete($bdd, "SELECT * FROM eleves_groupes WHERE id_groupe=".$_GET["id"]) as $i=>$data){
    echo "eleves_groupe.push(".$data["id_eleves"].");";
}

?>

</script>
<form id="form_group" name="form_group" method="POST" action="modify_group2.php">
    <input id="eleves" name="eleves" style="display:none;" value=""/>
    <div id="eleves">

    </div>
    <div>
        <select id="select_eleves"></select>
        <button>Ajouter</button>
    </div>
    <a class="bt" href="#" onclick="">Ok</a>
</form>
<script>

function update(){
    var dsel=document.getELementById("select_eleves");
    var deleves=document.getElementById("eleves");
    //
    for(c of dsel.children){
        desl.removeChild(c);
    }
    for(ide of eleves){
        if(!eleves_groupe.includes(ide)){
            var o = document.createElement("option");
            o.setAttribute("value", ide);
            o.innerHTML=eleves[ide];
            dsel.appendChild(o);
        }
    }
    //
    for(c of deleves){
        deleves.removeChild(c);
    }
    for(ide of eleves_groupe){
        var d=document.createElement("div");
        var t=document.createElement("h2");
        t.innerHTML=eleves[ide];
        var bt_del=document.createElement("button");
        d.appendChild(t);
        d.appendChild(bt_del);
        deleves.appendChild(d);
    }
}

update();

</script>
