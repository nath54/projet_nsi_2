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
    $data["id_classe"] = $_POST["id_classe"];
    $succeed = inscription($bdd, $data);
    //
    if($succeed){
        foreach($_POST as $k=>$v){
            if(startsWith($k, "imatiere")){
            }
            else if(startsWith($k, "ienfant")){
            }
            else if(startsWith($k, "igroupes")){
            }
        }
    }
}

?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ultranote</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
        <link href="../css/style_dark.css" rel="stylesheet" />
        <link href="../css/inscription.css" rel="stylesheet" />
    </head>
    <body>
        <div>
            <?php
            if($succeed){
                echo("<h1>Votre compte a été créé !</h1><p>Retournez à l'accueil vous connecter</p>");
            }else{
                echo("<h1>Il y a eu une erreur !</h1><p>".$result["error"]."</p>");
            }
            ?>
            <a href="../index.php">Accueil</a>
        </div>
    </body>
</html>
