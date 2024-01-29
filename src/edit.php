<?php

    include("header.php");

    include("pdo.php");

    print_r($_GET[id]);
    $req_delete = ("UPDATE FROM favori WHERE id_fav=".$_GET[id].";");
    
    
    ?>