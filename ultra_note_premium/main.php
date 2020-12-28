<?php
include("includes/init.php");
include("includes/bdd.php");

$bdd = load_db("includes/");

if(isset($_SESSION["id"])){
    $id_account = $_SESSION["id"];
    $r = get_account($bdd, $id_account);
    if(count($r)>0){
        $compte = $r[0];
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
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=viewport-width, initial-scale=1">
        <title>UltraNote++ Premium Edition</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
        <link href="css/style_dark.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />
        <script src="js/main.js"></script>
    </head>
    <body>
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

        </div>
        <!-- footer -->
        <?php include("includes/footer.php"); ?>
    </body>
</html>