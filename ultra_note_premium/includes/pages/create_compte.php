<?php

include_once "../init.php";
include_once "../bdd.php";

?>
<form id="finscription" method="POST", action="includes/pages/create_compte2.php">
<?php
$_SESSION["mode_inscription"]="admin";
include "../inscription_compte.php";
?>
</form>
