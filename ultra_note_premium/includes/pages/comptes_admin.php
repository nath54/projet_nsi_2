<?php

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
    $td .= "<div class='row_wrap row_bt'> <button class='bt_edit'></button> <button class='bt_delete' onclick='delete_account(".$data["id"].")'></button> </div>";
    $td .= "</div>";
    echo $td;
}

?>

<div id="compte_plus" class="div_compte" onclick="change_page('create_compte');">
    <h1>+</h1>
</div>

</div>
