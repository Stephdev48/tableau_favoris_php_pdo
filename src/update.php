<!-- Envoi de la requête de modification -->
<?php
    include("header.php");
    include("pdo.php");
    
    if(count($_POST)>0){

        //Récupération des champs du formulaire
        $nom = htmlspecialchars($_POST['nom']);
        $dom = htmlspecialchars($_POST['dom']);
        $url = htmlspecialchars($_POST['url']);



        if ((!empty($_POST['cat']) && (!empty($_POST['dom'])))){       
        
            //Modification de la ligne dans la table favori
            $modifier_favori = ("UPDATE favori SET libelle=:nom, id_dom=:dom, url=:url WHERE id_fav=:id_fav;");
            $arrayParam = array(':nom' => $nom, ':dom' => $dom, ':url' => $url, ':id_fav' => $_GET['id']);
            $result_final_fav = $pdo->prepare($modifier_favori); 
            $result_final_fav->execute($arrayParam);
        


            //Modification des catégories
                //suppression de tous les id_cat
                $cats_delete = ("DELETE FROM cat_fav WHERE id_fav=:id_fav;");
                $exec = $pdo->prepare($cats_delete);
                $exec->execute(array(':id_fav'=>$_GET['id']));

                //ajout des nouveaux id_cat
                foreach($_POST['cat'] as $cat){
                    $ajout_id_cat = ("INSERT INTO cat_fav (id_fav, id_cat) VALUES (:id_favori, :cat);");
                    $arrayParam = array(':id_favori'=>$_GET['id'], ':cat'=>$cat);
                    $result_id_fav = $pdo->prepare($ajout_id_cat);
                    $result_id_fav->execute($arrayParam);
                }


            //Redirection vers index.php
            header('Location: index.php?modif='.$_GET['id']);

        }else{
            echo "<script>alerte()</script>";
        }
    }
?>




<!-- Inclusion header et récupération du favoris à modifier-->
<?php


    //Récupération des données du favoris à modifier :
    $modif_fav = $pdo->query("SELECT * FROM favori WHERE id_fav=$_GET[id]");
    $fav_a_modif = $modif_fav->fetch(PDO::FETCH_ASSOC);


    // Récupération des catégories du favori à modifier :
    $recup_cat = $pdo->query("SELECT * FROM cat_fav WHERE id_fav=$_GET[id]");
    $cat_cat = $recup_cat->fetchAll(PDO::FETCH_ASSOC);    


    // Récupération des catégories pour le menu déroulant :
    $result_cat = $pdo->query("SELECT * FROM categorie");
    $categories = $result_cat->fetchAll(PDO::FETCH_ASSOC);


    // Récupération des domaines pour le menu déroulant :
    $result_dom = $pdo->query("SELECT * FROM domaine");
    $domaines = $result_dom->fetchAll(PDO::FETCH_ASSOC);

    //Récupération du nom des catégories :
    $req_nom_cat = ("SELECT nom_cat FROM categorie INNER JOIN cat_fav ON categorie.id_cat = cat_fav.id_cat WHERE cat_fav.id_fav = ".$_GET['id'].";");
    $cat_name = $pdo->query($req_nom_cat);
    $nom_cat = $cat_name->fetchAll(PDO::FETCH_ASSOC);

    //Récupération du nom de domaine avant modif' :
    $req_nom_dom = ("SELECT nom FROM domaine WHERE id_dom=$fav_a_modif[id_dom];");
    $domain_name = $pdo->query($req_nom_dom);
    $nom_dom = $domain_name->fetch(PDO::FETCH_ASSOC);

?>




<!-- Formulaire de modification du favori -->
<section class="flex-col justify-center border-solid border-black border-2 bg-stone-300 m-10 mx-60 rounded-2xl p-16">
    <h2 class="text-center text-5xl m-4 font-bold">Modifier favori</h2>
    <form action="" method="post" class="text-center">
        <ul class="flex-col m-16">

            <!--Champ nom-->
            <li class="flex-col m-2">
                <label for="nom" class="flex text-xl justify-center p-2">Nom du favori</label>
                <input type="text" id="nom" name="nom" class="rounded-md p-3" required size="50" value="<?php echo $fav_a_modif['libelle']?>"/>
            </li>

            <!--Menu catégories-->
            <li class="flex-col m-6">
                <label class="flex items-center text-xl justify-center">Catégorie</label>
                <span class="flex justify-center text-sm p-1">( Maintenir CTRL pour sélectionner plusieurs catégories )</span>
                <div class="flex justify-center items-center m-2">
                    <h3 class="mr-3 p-3 rounded-lg bg-white italic text-cyan-700 h-1/6">Catégories avant modif' : <?php foreach($nom_cat as $cat_names){echo "<p>".$cat_names['nom_cat']."</p>";}?></h3>
                    <select class="cursor-pointer hover:bg-slate-100 hover:shadow-xl rounded-lg p-3" id="cat" name="cat[]" multiple>
                        <option value="">-- Choix des catégories --</option>
                            <?php 
                                foreach($categories as $categorie){
                                ?>
                                <option value="<?php echo $categorie['id_cat']?>"><?php echo $categorie['id_cat']." &nbsp ".$categorie['nom_cat']?></option>
                                <?php
                                }
                            ?>
                    </select>
                </div>
            </li>

            <!--Menu domaines-->
            <li class="flex-col m-6">
                <label class="flex items-center text-xl justify-center p-2">Domaine</label>
                <div class="flex justify-center m-2">
                    <h3 class="mr-3 p-3 rounded-lg italic bg-white text-cyan-700">Domaine avant modif' : <?php echo $nom_dom['nom'];?></h3>
                    <select id="dom" name="dom" class="cursor-pointer hover:bg-slate-100 hover:shadow-xl rounded-lg p-3">
                        <option value="">-- Choix du domaine --</option>
                        <?php 
                            foreach($domaines as $domaine){
                            ?>
                            <option value="<?php echo $domaine['id_dom']?>"><?php echo $domaine['nom']?></option>
                            <?php
                            }
                        ?>
                    </select>
                </div>
            </li>

            <!--Champ URL-->
            <li class="flex-col m-2">
                <label class="flex text-xl justify-center p-2">Adresse URL</label>
                <input type="url" id="url" name="url" class="rounded-md p-3" required size="55" value="<?php echo $fav_a_modif['url']?>"/>
            </li>
        </ul>

            <!--Bouton d'envoi de la mise à jour-->
        <div class="flex justify-center m-4">                   
           <button type='submit' value='envoyer' class='bg-neutral-400 text-2xl font-bold rounded-lg p-2 border-solid border-black border-2 mb-5'>Mettre à jour</button>
        </div>
    </form>
</section>




<!-- Inclusion footer -->
<?php
    include("footer.php");
?>