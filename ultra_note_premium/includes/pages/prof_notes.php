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
echo "var notes_matiere={};";

foreach($groupes as $i=>$data){
    echo "notes_matiere[".$data["id"]."]=[];";
}
$requested="SELECT * FROM notes WHERE notes.id_prof=".$id_prof;
echo "</script>".$requested."<script>";
foreach(requete($bdd, $requested) as $i=>$data){
    $note="{'id': ".$data["id"]."}";
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
    </div>


    <div>
        <table>
            <thead>
                <tr></tr>
           </thead>
            
           <tbody id="tableau_note">
                
           </tbody>
        </table>
        <button class="bt_form" onclick="nouvelle_note();">Nouvelles Notes</button>
    </div>

</div>

<div id="nouvelle_note">
    <form method="POST" action="includes/utils/nouvelle_note.php">
        <h1>Nouvelle Note :</h1>
        <div class="row">
        <label></label>
        </div>
    </form>
</div>

<script>

function nouvelle_note(){

}

function update_notes(){
    var idg = document.getElementById("select_groupes");
    var tab=document.getElementById("tableau_note");
    // On nettoie
    for(c of tab.children){
        tab.removeChild(c);
    }
    tab.innerHTML="";
    tab.children=[];
    // On les rajoutes
}

</script>