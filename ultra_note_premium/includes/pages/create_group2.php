<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd=load_db("../");

test_admin($bdd);

$requested="INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ('".$_POST["nom"]."', '".$_POST["niveau"]."', ".$_POST["etablissement"]." );";
echo $requested;
action($bdd, $requested);

echo "<script>window.location.href='../../main.php?page=etablissement_admin'</script>"

?>

