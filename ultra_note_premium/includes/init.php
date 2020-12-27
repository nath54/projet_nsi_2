<?php

session_start();

// Quelques fonctions utiles

function startsWith($var, $txt) {
    return substr_compare($var, $txt, 0, strlen($txt)) === 0;
}
function endsWith($var, $txt) {
    return substr_compare($var, $txt, -strlen($txt)) === 0;
}

function aff_array($ar){
    echo "<table>";
    foreach($ar as $k=>$v){
        echo "<tr><td>".$k."</td><td>".$v."</td></tr>";
    }
    echo "</table>";
}


?>