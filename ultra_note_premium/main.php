<?php
include("includes/init.php");
include("includes/bdd.php");

$bdd = load_db("includes/");

if(isset($_SESSION["id"])){
    $id_account = $_SESSION["id"];
    $results = requete($bdd, "SELECT * FROM comptes WHERE id=".$id_account);
    if(count($results)>0){
        $compte = $results[0];
        echo("<script>sessionStorage['tp_compte']='".$compte["type_"]."'</script>");
    }
    else{
        echo("<script>alert('erreur !');</script>");
        echo("<script>window.location.href='index.php'</script>");
    }
}
else{
    echo("<script>alert('erreur !');</script>");
    echo("<script>window.location.href='index.php'</script>");
}

?>
<script>
sessionStorage["bt_actif"]=null;
sessionStorage["actual_page"]="accueil_"+sessionStorage['tp_compte'];
</script>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=viewport-width, initial-scale=1">
        <title>UltraNote++ Premium Edition</title>
        <!--
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
        -->
        <link href="css/google_fonts/arvo.css" rel="stylesheet" />
        <link href="css/google_fonts/lato.css" rel="stylesheet" />
        <link href="css/style_dark.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />
        <script src="js/lib.js"></script>
        <script src="js/main.js"></script>
        <script src="js/forms.js"></script>
        <script src="js/jquery.js"></script>
    </head>
    <body onload="on_load();">
        <!-- header -->
        <?php
        if($compte["type_"]=="eleve"){
            include("includes/header_eleve.html");
        }else if($compte["type_"]=="prof"){
            include("includes/header_prof.html");
        }else if($compte["type_"]=="admin"){
            include("includes/header_admin.html");
        }else if($compte["type_"]=="parent"){
            include("includes/header_parent.html");
        }
        ?>
        <!-- Main -->
        <div id="div_main" class="div_main">
            <?php
            if($compte["type_"]=="eleve"){
                include("includes/pages/accueil_eleve.php");
            }else if($compte["type_"]=="prof"){
                include("includes/pages/accueil_prof.php");
            }else if($compte["type_"]=="admin"){
                include("includes/pages/accueil_admin.php");
            }else if($compte["type_"]=="parent"){
                include("includes/pages/accueil_parent.php");
            }
            ?>
        </div>
    </body>
</html>
<script src="js/prenoms.js"></script>