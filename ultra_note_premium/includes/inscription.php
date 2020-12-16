<?php

includes("includes/init.php");
includes("includes/bdd.php");

if(isset($_POST["ipseudo"])){
    $array = array();
    foreach($_POST as $key=>$value){
        if($key=="ipseudo"){
            $array["pseudo"] = $value;
        }
        else if($key=="ipassword"){
            $array["password"] = $value;
        }
        else{
            $array[$key]=$value;
        }
    }
    $result = inscription($array);
    if($result["succed"]){

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
