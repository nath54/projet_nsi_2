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

$requested="INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ('".$_POST["nom"]."', '".$_POST["niveau"]."', ".$_POST["etablissement"]." );";
echo $requested;
action($bdd, $requested);

echo "<script>window.location.href='../../main.php?page=etablissement_admin'</script>"

?>

