<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");
$id_prof = $_SESSION["id"];

$groupes = requete($bdd, "SELECT * FROM groupes INNER JOIN prof_groupes ON groupes.id=id_groupe AND id_prof=".$id_prof)

?>
<div>

<?php

foreach($groupes as $i=>$data){
    echo "<div> <h1>".$data["nom"]."</h1> </div>";
}

?>

</div>
