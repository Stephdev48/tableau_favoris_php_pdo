<!-- Envoi de la requête de création -->
<?php

    include("pdo.php");
    if(count($_POST)>0){

        //Récupération des champs du formulaire
        $nom = htmlspecialchars($_POST['nom']);
        $array_cat = ($_POST['cat']);
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
        foreach($array_cat as $cat){
            $ajout_id_cat = ("INSERT INTO cat_fav (id_fav, id_cat) VALUES (:id_favori, :cat);");
            $arrayParam1 = array(':id_favori'=>$last_id_fav, ':cat'=>$cat);
            $result_id_fav = $pdo->prepare($ajout_id_cat);
            $result_id_fav->execute($arrayParam1);
        }

        header('Location: index.php?create='.$last_id_fav );

    }
?>


<!-- Inclusion header -->
<?php

    include("header.php");
    
    // Récupération des catégories :
    $result_cat = $pdo->query("SELECT * FROM categorie");
    $categories = $result_cat->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des domaines :
    $result_dom = $pdo->query("SELECT * FROM domaine");
    $domaines = $result_dom->fetchAll(PDO::FETCH_ASSOC);

?>


<!-- Formulaire de saisie du nouveau favori -->
<section class="flex-col justify-center border-solid border-black border-2 bg-stone-300 m-10 mx-60 rounded-2xl p-16">
    <h2 class="text-center text-4xl m-4 font-bold">Nouveau favori</h2>
    <h3 class="text-center text-2xl">Champs à renseigner :</h2>
    <form action="" method="post" class="text-center">
        <ul class="flex-col m-20">

            <!--Champ nom-->
            <li class="flex-col m-2">
                <label for="nom" class="flex text-xl justify-center p-2">Nom du favori</label>
                <input type="text" id="nom" name="nom" class="rounded-md p-2" required size="32"></input>
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
                <input type="url" id="url" name="url" class="rounded-md p-2" required size="32"></input>
            </li>
        </ul>

            <!--Bouton d'envoi du formulaire-->
        <div class="flex justify-center m-4">
            <button type="submit" value="envoyer" class="bg-stone-500 text-white text-2xl font-bold rounded-lg p-2 border-solid border-black border-2 mb-5">Envoyer</button>
        </div>
    </form>
</section>


<!-- Inclusion footer -->
<?php
    include("footer.php");
?>