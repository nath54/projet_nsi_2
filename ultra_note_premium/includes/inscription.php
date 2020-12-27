<style>
table, td, tr{
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
<?php

include("init.php");
include("bdd.php");

$bdd = load_db();


if(isset($_POST["itype"])){
    //
    $data = array();
    $data["pseudo"] = $_POST["ipseudo"];
    $data["password_"] = md5($_POST["ipassword"]);
    $data["nom"] = $_POST["inom"];
    $data["prenom"] = $_POST["iprenom"];
    $data["type_"] = $_POST["itype"];
    $data["id_etablissement"] = intval($_POST["ietablissement"]);
    $data["naissance"] = "".$_POST["ian"]."-".$_POST["imois"]."-".$_POST["ijour"];
    $result = inscription($bdd, $data);
    //
    foreach($_POST as $k=>$v){
        if(startsWith($k, "imatiere")){

        }
        else if(startsWith($k, "ienfant")){
            
        }
        else if(startsWith($k, "igroupes")){
            
        }
    }
}

?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ultranote</title>
        <link href="../css/style.css" rel="stylesheet" />
    </head>
    <body>
        <div>
            <h1>Votre compte a été créé !</h1>
            <a href="../index.php">Accueil</a>
        </div>
    </body>
</html>
