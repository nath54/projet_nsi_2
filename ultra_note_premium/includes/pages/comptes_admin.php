<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");


?>

<div class="row_wrap">

<?php

// normalement, la variable $bdd contient l'objet connecté a la base de donnée, car initialisée
// au début de la création de la page

$accounts = requete($bdd, "SELECT * FROM comptes;");

foreach($accounts as $i=>$data){
    $td = "<div class='div_compte'>";
    $td .= "<h1>".$data["nom"]." ".$data["prenom"]."</h1>";
    $td .= "<p>".$data["type_"]."</p>";

    $td .= "<div class='row_wrap row_bt'> <button class='bt_edit'></button> <button class='bt_delete'></button> </div>";
    $td .= "</div>";
    echo $td;
}

?>

</div>
