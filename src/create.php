<!-- Inclusion header et fichier pdo -->
<?php
    include("header.php");
    include("pdo.php");

    // Récupération des catégories :
    $result_cat = $pdo->query("SELECT * FROM categorie");
    $categories = $result_cat->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des domaines :
    $result_dom = $pdo->query("SELECT * FROM domaine");
    $domaines = $result_dom->fetchAll(PDO::FETCH_ASSOC);


    ?>




<!-- Formulaire de saisie du nouveau favori -->
<section class="flex-col justify-center border-solid border-black border-2 bg-green-400 m-6 rounded-2xl">
    <h2 class="text-center text-4xl m-6 font-bold">Nouveau favori</h2>
    <h3 class="text-center text-xl">Champs à renseigner :</h2>
    <form action="" method="post" class="text-center">
        <ul class="flex-col m-20">
            <li class="flex-col m-2">
                <label for="nom">Nom du favori</label>
                <input type="text" id="nom" name="nom" class="rounded-md"></input>
            </li>
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
            <li class="flex-col m-2">
                <label>Adresse URL</label>
                <input type="url" id="url" name="url" class="rounded-md"></input>
            </li>
        </ul>
        <div class="flex justify-center">
            <button type="submit" value="envoyer" class="bg-red-500 text-2xl font-bold rounded-lg p-2 border-solid border-black border-2 mb-5">Envoyer</button>
        </div>
    </form>
</section>



<?php

    $nom = htmlspecialchars($_POST['nom']);
    $cat = htmlspecialchars($_POST['cat']);
    $url = htmlspecialchars($_POST['url']);
    $dom = htmlspecialchars($_POST['dom']);

    echo $nom." ".$cat." ".$url." ".$dom." ".date('Y-m-d');


    $creer_favori = ("INSERT INTO favori (libelle, date_creation, url, id_dom)  VALUES('$nom', 'date('Y-m-d')', '$url', '$dom')");
    $ajout_cat = ("INSERT INTO categorie VALUES('$cat');");
    $result_fav = $pdo->prepare($creer_favori);
    $creer_favori->execute();
    
    ?>





<!-- Inclusion footer -->
<?php
    include("footer.php");
    ?>