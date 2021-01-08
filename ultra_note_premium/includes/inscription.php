<style>
table, td, tr{
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
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
    $result = inscription($bdd, $data);
    $succeed = $result["succeed"];
    //
    if($succeed){
        $id_compte=$result["id_compte"];
        if($data["type_"]=="prof"){
            $mats = $_POST["prof_matieres"];
            $id_mats = explode("|", $mats);
            foreach($id_mats as $i=>$id_){
                $requested="INSERT INTO profs_matieres (id_matiere, id_prof) VALUES (".$id_.", ".$id_compte.");";
                action($bdd, $requested);
            }
            //
            $grps = $_POST["prof_groupes"];
            $id_grps = explode("|", $grps);
            foreach($id_grps as $i=>$id_){
                action($bdd, "INSERT INTO profs_groupes (id_groupe, id_prof) VALUES (".$id_.", ".$id_compte.");");
            }
        }
        //
        if($data["type_"]=="parent"){
            $enfs = $_POST["parent_enfants"];
            $id_enfs = explode("|", $mats);
            foreach($id_enfs as $i=>$id_){
                action($bdd, "INSERT INTO parents_enfants (id_enfant, id_prof) VALUES (".$id_.", ".$id_compte.");");
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
