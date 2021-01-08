<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once("$root/projet_nsi_2/ultra_note_premium/includes/init.php");
include_once("$root/includes/bdd.php");

$bdd=load_db("../");
test_admin($bdd);

?>


<form id="finscription" method="POST", action="includes/pages/modify_account2.php">
<?php

$_SESSION["mode_inscription"]="admin";
$_SESSION["id_compte_modif"]=$_GET["id_account"];
include "../inscription_compte.php";
?>
</form>
