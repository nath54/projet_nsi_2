
<link href="../../style_dark.css" rel=stylesheet />
<?php

/*
Ici, on va faire un include sur le fichier `init.php`,
qui chargera la session ainsi que quelques petites fonctons en php,
On va aussi inclure le fichier `bdd.php`, 
qui nous permet de récupérer la base de donnée (fonction load_db),
et qui fourni aussi quelques fonctions utiles pour l'interaction avec la base de donnée,
les plus utilisées sont `requete()` et `action()`,
qui servent respectivement à récuperer des tableaux et à faire des modifications à la base de donnée.

J'ai du mettre sous cette forme à cause d'un probleme de chemins pour acceder au fichiers, 
du a l'arborescence de fichiers du projets, qui commence a etre certe sophistiquée,
mais aussi surtout bien utile lorsqu'il s'agit de s'organiser
*/
$pathe=explode(DIRECTORY_SEPARATOR,getcwd());
$laste=$pathe[count($pathe)-1];
if($laste=="pages" || $laste=="utils"){
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

test_compte($bdd, "admin");

if(isset($_POST["itype"])){
    $id_compte=$_SESSION["id_compte_modif"];
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
    $succeed = modification_compte($bdd, $data, $id_compte);
    if($succeed){
        if($data["type_"]=="prof"){
            action($bdd, "DELETE FROM profs_matieres WHERE id_prof = ".$id_compte);
            action($bdd, "DELETE FROM profs_groupes WHERE id_prof = ".$id_compte);
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
                $requested="INSERT INTO profs_groupes (id_groupe, id_prof) VALUES (".$id_.", ".$id_compte.");";
                action($bdd, $requested);
            }
        }
        //
        if($data["type_"]=="parent"){
            action($bdd, "DELETE FROM parents_enfants WHERE id_prof = ".$id_compte);
            $enfs = $_POST["parent_enfants"];
            $id_enfs = explode("|", $mats);
            foreach($id_enfs as $i=>$id_){
                action($bdd, "INSERT INTO parents_enfants (id_enfant, id_prof) VALUES (".$id_.", ".$id_compte.");");
            }
        }
        $_SESSION["mode_inscription"]=null;
        $_SESSION["id_compte_modif"]=null;
        echo "<script>window.location.href='../../main.php?page=comptes_admin';</script>";
    }
    else{
        $_SESSION["mode_inscription"]=null;
        $_SESSION["id_compte_modif"]=null;
        echo "<script>alert('il y a eu une erreur !');</script>";
        echo "<script>window.location.href='../../index.html';</script>";
    }
    $_SESSION["mode_inscription"]=null;
    $_SESSION["id_compte_modif"]=null;
}




?>





