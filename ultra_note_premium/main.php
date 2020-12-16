<?php
include("includes/header.php");
include("includes/bdd.php");

if(isset($_SESSION["id"])){
    $db = $_SESSION["id"];
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
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />
    </head>
    <body>
        <!-- header -->
        <?php include("includes/header.php"); ?>
        <!-- Main -->
        <div>
            <div>
                <h2>UltraNote</h2>
            </div>
        </div>
        <!-- footer -->
        <?php include("includes/footer.php"); ?>
    </body>
</html>