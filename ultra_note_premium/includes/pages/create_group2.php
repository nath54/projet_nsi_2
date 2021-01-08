<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once("$root/projet_nsi_2/ultra_note_premium/includes/init.php");
include_once("$root/includes/bdd.php");

$bdd=load_db("../");

test_admin($bdd);

$requested="INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ('".$_POST["nom"]."', '".$_POST["niveau"]."', ".$_POST["etablissement"]." );";
echo $requested;
action($bdd, $requested);

echo "<script>window.location.href='../../main.php?page=etablissement_admin'</script>"

?>

