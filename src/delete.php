<!-- Inclusion header et fichier pdo -->
<?php
    include("header.php");
    include("pdo.php");
    ?>




<!-- Requête de suppression -->
<?php
    $req_delete = ("DELETE FROM favori WHERE id_fav=".$_GET['id_del'].";");
    $exec = $pdo->prepare($req_delete);
    if($exec->execute()==true){
        echo "<h2 class='text-3xl text-center m-40 font-bold'>Le favori a bien été supprimé de la base de données.<br>Vous allez être redirigé dans 1 seconde...</h2>";
        header( "refresh:1; url=index.php" ); 
    }else{
        echo "<h2 class='text-3xl text-center m-40 font-bold'>Erreur lors de la suppression</h2>";
    }
    ?>



<!-- Insertion du footer -->
<?php
    include("footer.php");
    ?>