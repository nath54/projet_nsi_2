<style>
table, td, tr{
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
<?php

include("init.php");
include("bdd.php");

echo "<table>";
foreach($_POST as $k=>$v){
    echo "<tr><td>".$k."</td><td>".$v."</td></tr>";
}
echo "</table>";

if(isset($_POST["itype"])){
    if($_POST["ipassword"]!=$_POST["ipassword2"]){
        echo "<script>alert('Les mots de passes sont différents !');</script>";
        echo "<script>window.location.href='../index.php';</script>";
    }
    else if(strlen($_POST["ipassword"])<8){
        echo "<script>alert('Le mot de passe doit faire au moins 8 characteres !');</script>";
        echo "<script>window.location.href='../index.php';</script>";
    }
    else if(strlen($_POST["ipseudo"])<4){
        echo "<script>alert('Le pseudo doit faire au moins 4 characteres !');</script>";
        echo "<script>window.location.href='../index.php';</script>";
    }
    //
    
}

?>
