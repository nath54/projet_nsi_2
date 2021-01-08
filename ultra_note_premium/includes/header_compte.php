<?php

echo getcwd();


include_once("includes/init.php");
include_once("includes/bdd.php");

$bdd=load_db("includes/");

$compte = requete($bdd, "SELECT * FROM comptes WHERE id=".$_SESSION["id"])[0];

?>
<div class="row">
    <div class="column" style="text-align: left;">
        <b style="margin-top: 8px; margin-bottom:1px;"><?php echo $compte["nom"]; ?></b>
        <p style="margin-top: 1px; margin-bottom:4px;"><?php echo $compte["prenom"]; ?></p>
    </div>
    <p style="margin:auto; margin-left: 12px;"><?php echo $compte["type_"]; ?></p>
</div>