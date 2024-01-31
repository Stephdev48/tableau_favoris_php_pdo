<!-- Inclusion header et fichier pdo -->
<?php
    include("header.php");
    include("pdo.php");
    ?>



<!-- Requête de lecture d'un favori -->
<?php
    $requete = ("SELECT * FROM favori WHERE id_fav=$_GET[id];");
    $single = $pdo->query($requete);     
    $single_fav = $single->fetch(PDO::FETCH_ASSOC);
    ?>


<!-- Affichage du résultat -->
<fieldset class="flex justify-center p-10 items-center border-solid border-black border-2 bg-indigo-300 m-20 rounded-2xl">
    <legend class="text-3xl font-bold bg-slate-300 p-3 rounded-lg border-solid border-black border-2">Détails du favori</legend>
    <h2 class="ml-14 text-xl font-bold"><?php print_r($single_fav["libelle"]);?></h2>
    <p class="ml-14 mr-14 text-xl font-bold">Favori créé le : <?php print_r($single_fav["date_creation"]);?></p>
    <a href="<?php echo $single_fav['url']?>" target='about_blank'class='text-blue-600 underline ml-14 text-xl font-bold'><?php echo $single_fav['url']?></a>
</fieldset>



<!-- Inclusion footer -->
<?php
    include("footer.php");
    ?>