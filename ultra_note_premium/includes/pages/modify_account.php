<?php

include_once "../init.php";
include_once "../bdd.php";

?>


<form id="finscription" method="POST", action="includes/pages/modify_account2.php">
<?php

$_SESSION["mode_inscription"]="admin";
$_SESSION["id_compte_modif"]=$_GET["id_account"];
include "../inscription_compte.php";
?>
</form>
