<!-- Inclusion header et fichier pdo -->
<?php
    include("header.php");
    include("pdo.php");
?>



<!-- Récupération du favori et de ses caractéristiques -->
<?php

    $requete = ("SELECT * FROM favori WHERE id_fav=$_GET[id];");
    $single = $pdo->query($requete);     
    $single_fav = $single->fetch(PDO::FETCH_ASSOC);

    $req_cat = ("SELECT id_cat FROM cat_fav WHERE id_fav=$_GET[id];");
    $list_cat = $pdo->query($req_cat);
    $cat_list = $list_cat->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($cat_list);
    // echo "</pre>";

    $req_dom = ("SELECT id_dom FROM favori WHERE id_fav=$_GET[id];");
    $domain = $pdo->query($req_dom);
    $id_dom = $domain->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($id_dom);
    // echo "</pre>";

    $req_nom_dom = ("SELECT nom FROM domaine WHERE id_dom=$id_dom[id_dom];");
    $domain_name = $pdo->query($req_nom_dom);
    $nom_dom = $domain_name->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($nom_dom);
    // echo "</pre>";

    $req_nom_cat = ("SELECT nom_cat FROM categorie INNER JOIN cat_fav ON categorie.id_cat = cat_fav.id_cat WHERE cat_fav.id_fav = ".$_GET['id'].";");
    $cat_name = $pdo->query($req_nom_cat);
    $nom_cat = $cat_name->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($nom_cat);
    // echo "</pre>";
?>



<!-- Affichage du résultat -->
<fieldset class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-6 p-8 border-solid border-black border-2 bg-stone-200 m-10 rounded-2xl">
    <legend class="text-2xl  text-white font-bold bg-stone-800 p-3 rounded-lg border-solid border-black border-2">Détails du favori</legend>
    <h2 class="text-xl flex items-center justify-center font-black"><?php print_r($single_fav["libelle"]);?></h2>
    <p class="ml-12 mr-12 text-lg font-bold text-center my-6 lg:my-0">Favori créé le : <br><span class="text-base font-medium"><?php print_r($single_fav["date_creation"]);?></span></p>
    <div class="flex justify-center my-6 lg:my-0">
        <div class="flex-col text-lg font-bold">
            <h3 class="mb-2 text-center">Lien</h3>
            <?php echo "<a href='".$single_fav['url']."' target='about_blank'><img src='images/link-solid.svg' width='50px' class='bg-teal-400 hover:bg-teal-500 rounded-lg p-1'/></a>";?>
        </div>
    </div>
    <div class="flex justify-center my-6 lg:my-0">
        <div class="ml-14 mr-14 text-lg font-bold lg:mt-6 xl:mt-0">
            <p class="text-center">ID du favori</p>
            <div class="flex justify-center">
                <p class="italic mt-2 text-center flex items-center justify-center text-white bg-stone-700 p-2 rounded-xl h-1/4 w-3/5">
                <?php echo $single_fav["id_fav"];?>
                </p>
            </div>
        </div>
    </div>
    <div class="flex justify-center my-6 lg:my-0">
        <div class="flex-col ml-14 mr-14 text-lg font-bold items-center justify-center">
            <p class="text-center">Catégories associées</p>
            <div class="flex justify-center">
                <div class="italic mt-2 flex items-center justify-center text-white bg-stone-700 p-2 rounded-xl h-1/4 space-x-4">
                    <?php 
                        if (!empty($nom_cat)){
                        foreach($nom_cat as $cat_names){
                            echo "<span class='text-center'>".$cat_names['nom_cat']."</span>";
                        }
                    }else{
                        echo "<p>( Aucune )</p>";
                    }
                    ?>
                </div> 
            </div>   
        </div>
    </div>
    <div class="flex justify-center">
        <div class="flex-col ml-14 mr-14 text-lg font-bold items-center justify-center lg:mt-6 xl:mt-0">
            <p class="text-center">Domaine</p>
            <div class="flex justify-center">
                <div class="italic mt-2 flex items-center justify-center text-white bg-stone-700 p-2 rounded-xl h-1/4">
                    <?php echo $nom_dom['nom']; ?>
                </div>
            </div>
        </div>
    </div>
</fieldset>



<!-- Inclusion footer -->
<?php
    include("footer.php");
?>