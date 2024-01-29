<?php

    include("header.php");

    include("pdo.php");



    print_r($_GET['id_del']);
    $req_delete = ("DELETE FROM favori WHERE id_fav=".$_GET['id_del'].";");
    $pdo->exec($req_delete);

    echo "<h2>Votre favori a bien été supprimé de la base de données</h2>";





    include("footer.php");

    
    ?>