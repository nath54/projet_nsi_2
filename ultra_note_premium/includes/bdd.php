<?php

/*
Fonction qui ouvre un fichier json et qui le décode pour le renvoyer avec la variable $data
*/
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

/*
Fonction qui sert a charger la base de donnée,
Le parametre $pathe est du au fait que ce fichier est inclus dans d'autre fichiers un peu
partout dans l'aborescence du projet
Il renvoie un objet de la classe PDO
*/
function load_db($pathe="./"){
    $file_path = $pathe."mariadb-config.json";
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

/*
Fonction qui regarde si le pseudo et le password d'un utilisateur sont bon pour le connecter,
S'ils ne le sont pas, la page de connection va afficher un message d'erreur
*/
function connection($pseudo, $password, $db){
    $requested = "SELECT id FROM comptes WHERE pseudo='".$pseudo."' AND password_='".$password."';";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    foreach($tab as $data){
        return array("succeed"=> true, "id"=>$data["id"]);
    }
    return array("succeed"=>false, "error"=>"Le compte n'existe pas ou le mot de passe est erroné");
}

/*
Fonction qui sert à inscrire un compte,
On ne peut pas avoir deux comptes avec le meme pseudo,
Les informations du compte sont dans le tableau $data
*/
function inscription($db, $data){
    $requested = "SELECT (pseudo) FROM comptes WHERE pseudo='".$data["pseudo"]."';";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    if(count($tab) != 0){
        return array("succeed"=>false, "error"=>"Un compte avec ce pseudo existe déjà");
    }
    else{
        $txt_nv = "(";
        $txt_v = "(";
        //
        foreach($data as $key=>$value){
            if($key!="id_classe"){
                if(gettype($value) == "string"){
                    $txt_nv = $txt_nv.$key.", ";
                    $txt_v = $txt_v."'".$value."', ";
                }
                else if(in_array(gettype($value), ["float", "real", "integer"])){
                    $txt_nv = $txt_nv.$key.", ";
                    $txt_v = $txt_v.strval($value).", ";
                }
            }
        }
        $txt_nv = substr($txt_nv, 0, -2).")";
        $txt_v = substr($txt_v, 0, -2).")";
        //
        $requested = "INSERT INTO comptes ".$txt_nv." VALUES ".$txt_v.";";
        $db->query($requested);
        $id_compte = $db->lastInsertId();
        //
        if($data["type_"]=="eleve"){
            $requested = "INSERT INTO eleves_classes (id_eleve, id_classe) VALUES (".$id_compte.", ".$data["id_classe"]." );";
            $db->query($requested);
            $requested = "INSERT INTO eleves_groupes (id_eleve, id_groupe) VALUES (".$id_compte.", ".$data["id_classe"]." );";
            $db->query($requested);
        }
        return array("succeed"=>true, "id_compte"=>$id_compte);
    }
}

/*
Fonction qui modifie un compte donné,
Avec les nouvelles données dans le tableau $data
*/
function modification_compte($db, $data, $id_compte){
    //
    $txt = "";
    foreach($data as $key=>$value){
        if($key=="password_" && $value==""){
            continue;
        }
        if(gettype($value) == "string"){
            $txt.= $key." = '".$value."', ";
        }
        else if(in_array(gettype($value), ["float", "real", "integer"])){
            $txt.= $key." = ".$value.", ";
        }
    }
    $txt = substr($txt, 0, -2);
    //
    $requested = "UPDATE comptes SET ".$txt." WHERE id=".$id_compte.";";
    $db->query($requested);
    //
    if($data["type_"]=="eleve"){
        $requested = "DELETE FROM eleves_classes WHERE id_eleve=".$id_compte.";";
        $db->query($requested);
        $requested = "DELETE FROM eleves_groupes WHERE id_eleve=".$id_compte.";";
        $db->query($requested);
        $requested = "INSERT INTO eleves_classes (id_eleve, id_classe) VALUES (".$id_compte.", ".$data["id_classe"]." );";
        $db->query($requested);
        $requested = "INSERT INTO eleves_groupes (id_eleve, id_groupe) VALUES (".$id_compte.", ".$data["id_classe"]." );";
        $db->query($requested);
    }
    return true;
}


//le fonctions suivante recuperent les informations de différents tables (établissement,matièrees,...)
function get_etablissements($db){
    $requested = "SELECT nom, id FROM etablissements;";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

function get_matieres($db){
    $requested = "SELECT * FROM matieres;";
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
// Cette fonction sert a récupérer des infos depuis la base de donnée
// On lui donne en argument la requete a effectuer ($requested)
// On renvoie ensuite les resultats sous la forme d'un tableau
function requete($db, $requested){
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

// Fonction pour executer une requete pour la bdd
// C'est bien plus pratique que de faire des milliers de fonctions comme ci-dessus
// Cette fonction sert a insérer/modifier des infos a la base de donnéee
// On lui donne en argument la requete a effectuer ($action)
function action($db, $action){
    $db->query($action);
}

/*
La fonction suivante est appelée à chaque début de page php, 
pour tester si l'utilisateur qui veut acceder a la page est bien un admin, un prof, un élève ou un parent
*/

function test_compte($bdd, $tp_compte){
    if(!isset($_SESSION["id"])){
        header("Location: index.php");
    }
    $id=$_SESSION["id"];
    $compte=requete($bdd, "SELECT type_ FROM comptes WHERE id=".$_SESSION["id"]);
    if(count($compte)==0){
        header("Location: index.php");
    }
    else{
        if($compte[0]["type_"]!=$tp_compte){
            header("Location: index.php");
        }
    }
}
?>
