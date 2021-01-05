<?php

session_start();

// Quelques fonctions utiles

function startsWith($var, $txt) {
    return substr_compare($var, $txt, 0, strlen($txt)) === 0;
}
function endsWith($var, $txt) {
    return substr_compare($var, $txt, -strlen($txt)) === 0;
}

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

function alert($txt){
    echo "<script>alert('".$txt."');</script>";
}

function loge($txt){
    echo "<script>console.log('".$txt."');</script>";
}

function get($array, $key){
    if(key_exists($key, $array)){
        return $array[$key];
    }
    return null;
}

?>