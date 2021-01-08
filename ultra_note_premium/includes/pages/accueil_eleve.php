<?php

include_once("includes/init.php");
include_once("includes/bdd.php");

$bdd=load_db("includes/");

test_eleve($bdd);

?>