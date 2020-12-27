<?php

include("init.php");
include("bdd.php");

$db = load_db();

if(isset($_POST["cpseudo"]) && isset($_POST["cpassword"])){
    $result = connection($_POST["cpseudo"], md5($_POST["cpassword"]), $db);
    if($result["succeed"]){
        $_SESSION["id"] = $result["id"];
        header("Location: ../main.php");
    }
    else{
        echo("<script>alert('Erreur !');</script>");
        echo("<script>window.location.href='../index.php';</script>");
    }
}
else{
    echo("<script>alert('Erreur !');</script>");
    echo("<script>window.location.href='../index.php';</script>");
}

?>
