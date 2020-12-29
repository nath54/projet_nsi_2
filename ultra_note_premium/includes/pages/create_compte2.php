

<?php

include_once "../init.php";
include_once "../bdd.php";

$bdd = load_db("../");

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
    else{
        echo "<script>alert('il y a eu une erreur !');</script>";
        echo "<script>window.location.href='../../index.html';</script>";
    }
}
else{
    echo "<script>window.location.href='../../main.html?page=\"comptes_admin\"';</script>";
}


?>





