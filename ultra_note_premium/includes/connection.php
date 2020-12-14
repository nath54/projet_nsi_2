<?php

includes("includes/init.php");
includes("includes/bdd.php");

if(isset($_POST["cpseudo"]) && isset($_POST["cpassword"])){
    $result = $connection($_POST["cpseudo"], $_POST["cpassword"]);
    if($result["succed"]){
        $_SESSION["id"] = $result["id"];
        header("Location: main.php");
    }
    else{
        echo("alert('Erreur !');");
        echo("<script>window.href.location='index.php'</script>");
    }
}
else{
    echo("alert('Erreur !');");
    echo("<script>window.href.location='index.php'</script>");
}

?>
