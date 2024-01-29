
<!-- Inclusion du header et du fichier PDO, et récupération de données dans la BDD "favoris" -->
<?php

    include("header.php");

    include("pdo.php");


    // Récupération des catégories :
    $result_cat = $pdo->query("SELECT * FROM categorie");
    $categories = $result_cat->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des domaines :
    $result_dom = $pdo->query("SELECT * FROM domaine");
    $domaines = $result_dom->fetchAll(PDO::FETCH_ASSOC);


    // Alimentation de la variable contenant la requête du filtre
    $requestSql = ("SELECT * FROM favori
                    INNER JOIN cat_fav      ON favori.id_fav = cat_fav.id_fav
                    INNER JOIN categorie    ON categorie.id_cat = cat_fav.id_cat
                    INNER JOIN domaine      ON domaine.id_dom = cat_fav.id_cat
                    WHERE 1=1
                ");

                if(!empty($_GET["categories"]) && empty($_GET["domaines"])){
                    $requestSql .= " AND cat_fav.id_cat = ".$_GET["categories"];
                }elseif(empty($_GET["categories"]) && !empty($_GET["domaines"])){
                    $requestSql .= " AND domaine.id_dom = ".$_GET["domaines"];
                }elseif(isset($_GET["categories"]) && isset($_GET["domaines"])){
                    $requestSql .= " AND cat_fav.id_cat = ".$_GET["categories"]." AND domaine.id_dom = ".$_GET["domaines"];
                }


                $resultat = $pdo->query($requestSql);     
                $favoris = $resultat->fetchAll(PDO::FETCH_ASSOC);


?>



<!-- Sélecteur de catégorie et de domaine et champ de recherche -->
    <section class="flex justify-center flex-col p-10 items-center border-solid border-black border-2 bg-indigo-300 m-6 rounded-2xl">
        <div class="flex items-center">
            <form action="" method="GET">
                <label class="text-3xl pr-5 font-bold">Catégories</label>
                <select name="categories" class="text-xl border-solid border-2 border-black rounded-xl p-2 cursor-pointer  hover:bg-slate-100 hover:shadow-xl">
                    <option value="">-- Choisissez une catégorie --</option>
                    <?php 
                        foreach($categories as $categorie){
                        ?>
                        <option value="<?php echo $categorie['id_cat']?>"><?php echo $categorie['nom_cat']?></option>
                        <?php
                        }
                    ?>
                </select>
                <label class="text-3xl pr-5 font-bold ml-20">Domaines</label>
                <select name="domaines" class="text-xl border-solid border-2 border-black rounded-xl p-2 cursor-pointer  hover:bg-slate-100 hover:shadow-xl">
                    <option value="">-- Choisissez un domaine --</option>
                    <?php 
                        foreach($domaines as $domaine){
                        ?>
                        <option value="<?php echo $domaine['id_dom']?>"><?php echo $domaine['nom']?></option>
                        <?php
                        }
                    ?>
                </select>
                <input type="submit" name="filtre" value="Filtrer" class="text-xl bg-lime-400 p-3 rounded-xl border-solid border-black border-2 ml-20 cursor-pointer hover:bg-lime-500">
            </form>
        </div>
        <form action="search.php" method="GET" class="flex pt-10 pb-2 text-xl font-semibold items-center">
            <h3 class="mr-8">Rechercher par mot-clé</h3>
            <input type="search" name="terme" class="rounded-lg p-2">
        </form>
    </section>



<!-- Tableau -->
    <section>
        <table class="flex justify-center m-10">
            <tr class=" bg-slate-400/60">
                <th class="border-solid border-2 border-black p-2.5 text-2xl">ID Favori</th>
                <th class="border-solid border-2 border-black p-2.5 text-2xl">ID Dom</th>  
                <th class="border-solid border-2 border-black p-2.5 text-2xl">Libellé</th>
                <th class="border-solid border-2 border-black p-2.5 text-2xl">Date ajout</th>
                <th class="border-solid border-2 border-black p-2.5 text-2xl">Lien</th>
                <th class="border-solid border-2 border-black p-2.5 text-2xl">Afficher</th>
                <th class="border-solid border-2 border-black p-2.5 text-2xl">Options</th>
            </tr>
            <?php 
                foreach($favoris as $favori){
                    ?>
                    <tr class="hover:bg-slate-300 odd:bg-slate-100 even:bg-slate-200">
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-center text-lg"><?php echo $favori["id_fav"];?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-center text-lg"><?php echo "$favori[id_dom]";?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-lg"><?php echo $favori["libelle"];?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-center text-lg"><?php echo $favori["date_creation"];?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-lg"><?php echo "<a href='".$favori['url']."' target='about_blank'class='text-teal-500 underline'>".$favori['url']."</a>";?></td>
                        <td class="border-solid border-2 border-black p-2.5 text-center">
                            <button type="submit" name="see" value="see"><a href="seeFavori.php?id=<?php echo $favori["id_fav"]?>" target='_blank'><img src="images/eye-regular.svg" alt="see_icon" width="35px" class="bg-violet-400 rounded-lg p-1"/></a></button>
                        </td>
                        <td class="border-solid border-2 border-black p-2.5 text-center">
                            <div class="flex justify-center items-center">
                                <?php echo "<a href='edit.php?id=".$favori["id_fav"]."'><img src='images/pen-to-square-regular.svg' alt='edit_icon' width='35px' class='bg-yellow-300 rounded-lg p-1'/></a>";
                                    ?>
                                <?php echo "<a href='delete.php?id_del=".$favori['id_fav']."' class='ml-2'><img src='images/trash-can-regular.svg' alt='delete_icon' width='32px' class='bg-red-500 rounded-lg p-1'/></a>";
                                    ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>

    </section>



<!-- Inclusion du footer -->
<?php

    include("footer.php");

?>