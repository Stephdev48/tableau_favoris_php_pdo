<!-- Inclusion header et fichier pdo et récupération du favoris à modifier-->
<?php

    include("header.php");
    include("pdo.php");


    //Récupération des données du favoris à modifier :
    $modif_fav = $pdo->query("SELECT * FROM favori WHERE id_fav=$_GET[id]");
    $fav_a_modif = $modif_fav->fetch(PDO::FETCH_ASSOC);
    echo "<pre>";
    var_dump($fav_a_modif);
    echo "</pre>";


    // Récupération des catégories du favori à modifier :
    $recup_cat = $pdo->query("SELECT * FROM cat_fav WHERE id_fav=$_GET[id]");
    $cat_cat = $recup_cat->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    var_dump($cat_cat);
    echo "</pre>";


    // Récupération des catégories pour le menu déroulant :
    $result_cat = $pdo->query("SELECT * FROM categorie");
    $categories = $result_cat->fetchAll(PDO::FETCH_ASSOC);


    // Récupération des domaines pour le menu déroulant :
    $result_dom = $pdo->query("SELECT * FROM domaine");
    $domaines = $result_dom->fetchAll(PDO::FETCH_ASSOC);

?>




<!-- Formulaire de modification du favori -->
<section class="flex-col justify-center border-solid border-black border-2 bg-teal-400 m-10 mx-60 rounded-2xl p-16">
    <h2 class="text-center text-4xl m-4 font-bold">Modifier favori</h2>
    <form action="" method="post" class="text-center">
        <ul class="flex-col m-16">

            <!--Champ nom-->
            <li class="flex-col m-2">
                <label for="nom" class="flex text-xl justify-center p-2">Nom du favori</label>
                <input type="text" id="nom" name="nom" class="rounded-md p-2" required size="32" value="<?php echo $fav_a_modif['libelle']?>"/>
            </li>

            <!--Menu catégories-->
            <li class="flex-col m-6">
                <label class="flex items-center text-xl justify-center">Catégorie</label>
                <span class="flex justify-center text-sm p-1">( Maintenir CTRL pour sélectionner plusieurs catégories )</span>
                <select class="cursor-pointer hover:bg-slate-100 hover:shadow-xl rounded-lg p-2" id="cat" name="cat[]" multiple>
                    <option value="">-- Choix des catégories --</option>
                        <?php 
                            foreach($categories as $categorie){
                            ?>
                            <option value="<?php echo $categorie['id_cat']?>"><?php echo $categorie['nom_cat']?></option>
                            <?php
                            }
                        ?>
                </select>
            </li>

            <!--Menu domaines-->
            <li class="flex-col m-6">
                <label class="flex items-center text-xl justify-center p-2">Domaine</label>
                <select id="dom" name="dom" class="cursor-pointer hover:bg-slate-100 hover:shadow-xl rounded-lg p-2">
                    <option value="">-- Choix du domaine --</option>
                    <?php 
                        foreach($domaines as $domaine){
                        ?>
                        <option value="<?php echo $domaine['id_dom']?>"><?php echo $domaine['nom']?></option>
                        <?php
                        }
                    ?>
                </select>
            </li>

            <!--Champ URL-->
            <li class="flex-col m-2">
                <label class="flex text-xl justify-center p-2">Adresse URL</label>
                <input type="url" id="url" name="url" class="rounded-md p-2" required size="55" value="<?php echo $fav_a_modif['url']?>"/>
            </li>
        </ul>

            <!--Bouton d'envoi de la mise à jour-->
        <div class="flex justify-center m-4">
            <button type="submit" value="envoyer" class="bg-red-500 text-2xl font-bold rounded-lg p-2 border-solid border-black border-2 mb-5">Mettre à jour</button>
        </div>
    </form>
</section>




<!-- Envoi de la requête de modification -->
<?php

    if(count($_POST)>0){

        //Récupération des champs du formulaire
        $nom = htmlspecialchars($_POST['nom']);
        $url = htmlspecialchars($_POST['url']);
        $dom = htmlspecialchars($_POST['dom']);
        $id_fav = $_GET['id'];


        //Modification de la ligne dans la table favori
        $modifier_favori = ("UPDATE favori SET libelle=':nom', url=':url', id_dom=':dom' WHERE id_fav=:id_fav;");
        $arrayParam = array(':nom' => $nom, ':url' => $url, ':dom' => $dom, ':id_fav' => $id_fav);
        $result_final_fav = $pdo->prepare($modifier_favori); 
        $result_final_fav->execute($arrayParam);

        header('Location: index.php?modif='.$_GET[id]);
    }
?>



<!-- Inclusion footer -->
<?php
    include("footer.php");
?>