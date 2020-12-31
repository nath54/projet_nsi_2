<?php

function open_json($file_path){
    if( file_exists($file_path) ){
        $texte = file_get_contents($file_path);
        $data = json_decode($texte, true);
    }
    else{
		echo("File doesn't exists : ".$file_path);
        $data=[];
    }
    return $data;
}


function load_db($pathe=""){
    $file_path = $pathe."mysql-config.json";
    $data_account = open_json($file_path);
    $pseudo = $data_account["pseudo"];
    $password = $data_account["password"];
    $db_name = $data_account["db-name"];
    $port = $data_account["port"];

    if (isset($_COOKIE["logged"]) and $_COOKIE["logged"] = true) {
        $_SESSION["logged"] = true;
    }

    try {
        $db = new PDO("mysql:host=localhost;port=".$port.";dbname=".$db_name.";charset=utf8", $pseudo, $password);
    }

    catch(Exception $e) {
        die("Error : " . $e->getMessage());
    }
    return $db;
}

function connection($pseudo, $password, $db){
    $requested = "SELECT id FROM comptes WHERE pseudo='".$pseudo."' AND password_='".$password."';";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    foreach($tab as $data){
        return array("succeed"=> true, "id"=>$data["id"]);
    }
    return array("succeed"=>false, "error"=>"Le compte n'existe pas ou le mot de passe est erroné");
}

function inscription($db, $data){
    $requested = "SELECT (pseudo) FROM comptes WHERE pseudo='".$data["pseudo"]."';";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    if(count($tab) >= 1){
        return array("succeed"=>false, "error"=>"Un compte avec ce pseudo existe déjà");
    }
    else{
        $txt_nv = "(";
        $txt_v = "(";
        //
        foreach($data as $key=>$value){
            if(gettype($value) == "string"){
                $txt_nv = $txt_nv.$key.", ";
                $txt_v = $txt_v."'".$value."', ";
            }
            else if(in_array(gettype($value), ["float", "real", "integer"])){
                $txt_nv = $txt_nv.$key.", ";
                $txt_v = $txt_v.strval($value).", ";
            }
        }
        $txt_nv = substr($txt_nv, 0, -2).")";
        $txt_v = substr($txt_v, 0, -2).")";
        //
        $requested = "INSERT INTO comptes ".$txt_nv." VALUES ".$txt_v;
        $db->query($requested);
        return true;
    }
}

function get_etablissements($db){
    $requested = "SELECT nom, id FROM etablissements;";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

function get_matieres($db){
    $requested = "SELECT nom FROM matieres;";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

function get_classes($db){
    $requested = "SELECT niveau, nom, id FROM classes;";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

function get_groupes($db){
    $requested = "SELECT nom, niveau, id FROM groupes;";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

function get_eleves($db){
    $requested = "SELECT nom, prenom, id FROM comptes WHERE type_='eleve';";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}


function get_account($db, $id_){
    $requested = "SELECT * FROM comptes WHERE id=".$id_.";";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

// Fonction pour recuperer des infos depuis la bdd
// C'est plus pratique que de faire des milliers de fonctions comme ci-dessus
// Cette fonction sert a récupérer des infos depuis la base de donnéee
function requete($db, $requested){
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

// Fonction pour executer une requete pour la bdd
// C'est bien plus pratique que de faire des milliers de fonctions comme ci-dessus
// Cette fonction sert a insérer/modifier des infos a la base de donnéee
function action($db, $action){
    $db->query($action);
}

/* exemple de requete

$requested = "";
$reponse = $db->query('SELECT * FROM '.$requested);
$tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
*/

?>
