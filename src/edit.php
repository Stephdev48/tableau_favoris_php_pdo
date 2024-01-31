<!-- Inclusion header et fichier pdo -->
<?php

    include("header.php");
    include("pdo.php");


    //Récupération des favoris :
    $tous_fav = $pdo->query("SELECT * FROM favoris");
    $all_fav = $tous_fav->fetchAll(PDO::FETCH_ASSOC);


    // Récupération des catégories :
    $result_cat = $pdo->query("SELECT * FROM categorie");
    $categories = $result_cat->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des domaines :
    $result_dom = $pdo->query("SELECT * FROM domaine");
    $domaines = $result_dom->fetchAll(PDO::FETCH_ASSOC);

?>




<!-- Formulaire de modification du favori -->
<section class="flex-col justify-center border-solid border-black border-2 bg-green-400 m-6 rounded-2xl">
    <h2 class="text-center text-4xl m-6 font-bold">Modifier favori</h2>
    <h3 class="text-center text-xl">Champs à renseigner :</h2>
    <form action="" method="post" class="text-center">
        <ul class="flex-col m-20">
            <!--Champ nom-->
            <li class="flex-col m-2">
                <label for="nom">Nom du favori</label>
                <input type="text" id="nom" name="nom" class="rounded-md"><?php  echo $all_fav;?></input>
            </li>
            <!--Menu catégories-->
            <li class="flex-col m-2">
                <label>Catégorie</label>
                <select class="cursor-pointer hover:bg-slate-100 hover:shadow-xl rounded-lg" id="cat" name="cat">
                    <option value="">-- Choisissez une catégorie --</option>
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
            <li class="flex-col m-2">
                <label>Domaine</label>
                <select id="dom" name="dom" class="cursor-pointer  hover:bg-slate-100 hover:shadow-xl rounded-lg">
                    <option value="">-- Choisissez un domaine --</option>
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
                <label>Adresse URL</label>
                <input type="url" id="url" name="url" class="rounded-md" required></input>
            </li>
        </ul>
            <!--Bouton d'envoi du formulaire-->
        <div class="flex justify-center">
            <button type="submit" value="envoyer" class="bg-red-500 text-2xl font-bold rounded-lg p-2 border-solid border-black border-2 mb-5">Envoyer</button>
        </div>
    </form>
</section>




<!-- Envoi de la requête de création -->
<?php

    if(count($_POST)>0){

        //Récupération des champs du formulaire
        $nom = htmlspecialchars($_POST['nom']);
        $cat = htmlspecialchars($_POST['cat']);
        $url = htmlspecialchars($_POST['url']);
        $dom = htmlspecialchars($_POST['dom']);


        //Insertion de la ligne dans la table favori
        $creer_favori = ("INSERT INTO favori (libelle, date_creation, url, id_dom)  VALUES(:nom, NOW(), :url, :dom)");
        $arrayParam = array(':nom' => $nom, ':url' => $url, ':dom' => $dom);
        $result_fav = $pdo->prepare($creer_favori);
        $result_fav->execute($arrayParam);


        //Récupération du dernier id_fav créé
        $stmt = $pdo->query("SELECT LAST_INSERT_ID()");
        $last_id_fav = $stmt->fetchColumn();


        //Insertion des id_cat dans cat_fav
        $ajout_id_cat = ("INSERT INTO cat_fav (id_fav, id_cat) VALUES ($last_id_fav, $cat);");
        $result_id_fav = $pdo->prepare($ajout_id_cat);
        $result_id_fav->execute();


        //Redirection vers index.php
        header( "refresh:1; url=index.php" ); 


    }
?>



<!-- Inclusion footer -->
<?php
    include("footer.php");
?>