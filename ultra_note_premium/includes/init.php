<?php

session_start();

define('SCRIPT_DEBUG', true);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Quelques fonctions utiles

/*
Fonction qui teste si une chaine de caractere commence par une autre chaine de charactere
*/
function startsWith($var, $txt) {
    return substr_compare($var, $txt, 0, strlen($txt)) === 0;
}
/*
Fonction qui teste si une chaine de caractere fini par une autre chaine de charactere
*/
function endsWith($var, $txt) {
    return substr_compare($var, $txt, -strlen($txt)) === 0;
}


/*
Fonction qui affiche un tableau php récursivement (s'il y a d'autres tableaux à l'intérieur du tableau)
*/
function aff_array($ar, $echo=true){
    $txtecho="<table class='tabarray'>";
    foreach($ar as $k=>$v){
        if(gettype($v)=="array"){
            $vv=aff_array($v, false);
        }
        else{
            $vv=$v;
        }
        $txtecho.= "<tr class='tabarray'><td class='tabarray'>".$k."</td><td class='tabarray'>".$vv."</td></tr>";
    }
    $txtecho.= "</table>";
    if($echo){
        echo $txtecho;
    }
    else{
        return $txtecho;
    }
}

/*
Fonction pour faire plus facilement un alert en javascript depuis le php (surtout utile pour debugger)
*/
function alert($txt){
    echo "<script>alert('".$txt."');</script>";
}

/*
Fonction pour faire plus facilement un console.log en javascript depuis le php (surtout utile pour debugger)
*/
function loge($txt){
    echo "<script>console.log('".$txt."');</script>";
}

/*
Fonction qui recupere une valeur depuis un tableau en php, et qui retourne null si elle n'existe pas
*/
function get($array, $key){
    if(key_exists($key, $array)){
        return $array[$key];
    }
    return null;
}

?>