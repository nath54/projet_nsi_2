<?php
session_start();

$file_path = "includes/mysql-config.json";

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

$data_account = open_json($file_path);

$pseudo = $data_account["pseudo"];
$password = $data_account["password"];
$db_name = $data_account["db-name"];

if (isset($_COOKIE["logged"]) and $_COOKIE["logged"] = true) {
	$_SESSION["logged"] = true;
}

try {
	$db = new PDO("mysql:host=localhost;dbname=".$db_name.";charset=utf8", $pseudo, $password);
}

catch(Exception $e) {
	die("Error : " . $e->getMessage());
}

function connection($pseudo, $password){
    $requested = "SELECT (id) FROM comptes WHERE pseudo='".$pseudo."' AND password=MD5('".$password."');";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    foreach($tab as $data){
        return array("succed"=> true, "id"=>$data["id"]);
    }
    return array("succed"=>false, "error"=>"Le compte n'existe pas ou le mot de passe est erroné");
}

function inscription($data){
    $requested = "SELECT (pseudo) FROM comptes WHERE pseudo=".$pseudo.";";
    $reponse = $db->query($requested);
    $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    if($tab.length >= 1){
        return array("succed"=>false, "error"=>"");
    }
    else{
        $txt_nv = "(";
        $txt_v = "(";
        //
        foreach($data as $key=>$value){
            if(gettype($value) == string){
                $txt_nv = $txt_nv.$key.",";
                $txt_v = "'".$txt_v.$value."',";
            }
            else if(in_array(gettype($value), [float, int])){
                $txt_nv = $txt_nv.$key.",";
                $txt_v = "".$txt_v.$value.",";
            }
        }
        $txt_nv = substr($txt_nv, 0, -1).")";
        $txt_v = substr($txt_v, 0, -1).")";
        //
        $requested = "INSERT INTO comptes VALUES";
        $id = $db::lastInsertId();
        return array("succed"=>true, "id"=>$id);
    }
}

/* exemple de requete

$requested = "";
$reponse = $db->query('SELECT * FROM '.$requested);
$tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
*/

?>
