<?php

include_once "includes/init.php";
include_once "includes/bdd.php";

$bdd = load_db("includes/");

$compte = requete($bdd, "SELECT * FROM comptes WHERE id=".$_SESSION["id"])[0];

?>
<div class="column" style="text-align: left;">
    <b><?php echo $compte["nom"]; ?></b>
    <p><?php echo $compte["prenom"]; ?></p>
</div>