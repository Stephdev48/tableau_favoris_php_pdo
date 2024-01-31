<!-- Inclusion header et fichier pdo -->
<?php
    include("header.php");
    include("pdo.php");
    ?>



<!-- Message de confirmation et de redirection -->
<?php
    echo "<h2 class='text-3xl text-center m-40 font-bold'>Le favori a bien été supprimé de la base de données.<br>Vous allez être redirigé dans 1 seconde...</h2>";
?>



<!-- Requête de suppression -->
<?php
    $req_delete = ("DELETE FROM favori WHERE id_fav=".$_GET['id_del'].";");
    $exec = $pdo->prepare($req_delete);
    $exec->execute();
    ?>


<!--Rediretion vers index.php-->
<?php 
  header( "refresh:1; url=index.php" ); 
?>


<!-- Insertion du footer -->
<?php
    include("footer.php");
    ?>