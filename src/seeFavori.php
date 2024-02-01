<!-- Inclusion header et fichier pdo -->
<?php
    include("header.php");
    include("pdo.php");
    ?>



<!-- Récupération du favori -->
<?php

    $requete = ("SELECT * FROM favori WHERE id_fav=$_GET[id];");
    $single = $pdo->query($requete);     
    $single_fav = $single->fetch(PDO::FETCH_ASSOC);

    $req_cat = ("SELECT id_cat FROM cat_fav WHERE id_fav=$_GET[id];");
    $list_cat = $pdo->query($req_cat);
    $cat_list = $list_cat->fetchAll(PDO::FETCH_ASSOC);

    $req_dom = ("SELECT id_dom FROM favori WHERE id_fav=$_GET[id];");
    $domain = $pdo->query($req_dom);
    $id_dom = $domain->fetch(PDO::FETCH_ASSOC);
    
?>




<!-- Affichage du résultat -->
<fieldset class="flex justify-center p-8 items-center border-solid border-black border-2 bg-indigo-300 m-20 rounded-2xl">
    <legend class="text-2xl font-bold bg-slate-300 p-3 rounded-lg border-solid border-black border-2">Détails du favori</legend>
    <h2 class="ml-14 text-lg font-bold"><?php print_r($single_fav["libelle"]);?></h2>
    <p class="ml-14 mr-14 text-lg font-bold">Favori créé le : <?php print_r($single_fav["date_creation"]);?></p>
    <a href="<?php echo $single_fav['url']?>" target='about_blank'class='text-blue-600 underline ml-14 mr-14 text-xl font-bold'><?php echo $single_fav['url']?></a>
    <div class="flex ml-14 mr-14 text-lg font-bold">
        <p class="underline underline-offset-4">Catégories associées</p>
        <div class="italic text-center flex items-center">
            <?php 
                foreach($cat_list as $categ){
                    echo "<span>".$categ['id_cat'].", </span>";
                }
            ?>
        </div>    
    </div>
    <div class="flex ml-14 mr-14 text-lg font-bold">
        <p class="underline underline-offset-4">Domaine</p>
        <div class="italic ml-2 text-center">
            <?php echo $id_dom['id_dom'] ?>
        </div>
    </div>
</fieldset>



<!-- Inclusion footer -->
<?php
    include("footer.php");
    ?>