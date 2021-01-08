
<link href="../../style_dark.css" rel=stylesheet />
<?php

include_once("../init.php");
include_once("../bdd.php");

$bdd=load_db("../");

test_admin($bdd);

if(isset($_POST["itype"])){
    //on prépare le tableau data avant de l'envoyer à la variable de sessesion
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
        echo "<script>window.location.href='../../main.php?page=comptes_admin';</script>";
    }
    else{
        echo "<script>alert('il y a eu une erreur !');</script>";
        echo "<script>window.location.href='../../index.html';</script>";
    }
}




?>





