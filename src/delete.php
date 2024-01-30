<?php
    include("header.php");
    include("pdo.php");
    ?>


<?php
    echo "<h2 class='text-3xl text-center m-40 font-bold'>Le favori a bien été supprimé de la base de données.<br>Vous allez être redirigé dans 5 secondes...</h2>";
    // echo "<div class='flex justify-center'><a href='index.php' class='text-2xl text-center m-20 font-bold bg-lime-400 p-3 rounded-xl'>Cliquez ici pour retourner dans vos favoris</a></div>";
    ?>
<?php 
  header( "refresh:5; url=index.php" ); 
?>

<?php
    $req_delete = ("DELETE FROM favori WHERE id_fav=".$_GET['id_del'].";");
    $exec = $pdo->prepare($req_delete);
    $exec->execute();

    include("footer.php");
    ?>