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

test_admin($bdd);

?>


<form id="finscription" method="POST", action="includes/pages/modify_account2.php">
<?php

$_SESSION["mode_inscription"]="admin";
$_SESSION["id_compte_modif"]=$_GET["id_account"];
include "../inscription_compte.php";
?>
</form>
