<?php
    include("header.php");
    include("pdo.php");
    ?>


<?php
    $requete = ("SELECT * FROM favori WHERE id_fav=$_GET[id];");

    $single = $pdo->query($requete);     
    $single_fav = $single->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($single_fav);
    // echo "</pre>";
    ?>



<fieldset class="flex justify-center p-10 items-center border-solid border-black border-2 bg-indigo-300 m-20 rounded-2xl">
    <legend class="text-3xl font-bold bg-slate-400 p-3 rounded-lg border-solid border-black border-2">Votre favori</legend>
    <h2 class="ml-14 text-xl font-bold"><?php print_r($single_fav["libelle"]);?></h2>
    <p class="ml-14 mr-14 text-xl font-bold">Favori créé le : <?php print_r($single_fav["date_creation"]);?></p>
    <a href="<?php echo $single_fav['url']?>" target='about_blank'class='text-teal-600 underline ml-14 text-xl font-bold'><?php echo $single_fav['url']?></a>
</fieldset>




<?php
    include("footer.php");
    ?>