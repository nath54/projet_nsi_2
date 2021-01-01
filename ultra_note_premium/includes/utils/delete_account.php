<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once("../init.php");
include_once("../bdd.php");

$bdd = load_db("../");

if(isset($_GET["id_account"]) && $_GET["id_account"]!=null){
    action($bdd, "DELETE FROM comptes WHERE id=".$_GET["id_account"]);
    action($bdd, "DELETE FROM eleves_classes WHERE id_eleve=".$_GET["id_account"]);
    echo "<script>alert('Le compte a bien été supprimé');</script>";
}

echo "<script>update();</script>"
?>