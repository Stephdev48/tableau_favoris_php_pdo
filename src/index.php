
<!-- Inclusion du header et du fichier PDO, et récupération de données dans la BDD "favoris" -->
<?php

    include("header.php");

    include("pdo.php");

    // Récupération des favoris :
    $result = $pdo->query("SELECT * FROM favori");
    $favoris = $result->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des catégories :
    $result_cat = $pdo->query("SELECT * FROM categorie");
    $categories = $result_cat->fetchAll(PDO::FETCH_ASSOC);

    // Affiche toutes les lignes :
    // echo "<pre>"; print_r($favoris); echo "</pre>";

?>



<!-- Sélecteur de catégories -->
    <section class="flex justify-center p-10 items-center border-solid border-black border-2 bg-indigo-300 m-6 rounded-2xl">
        <div class="flex items-center">
            <label class="text-3xl pr-5 font-bold">Catégories</label>
            <form action="" method="POST">
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
                <input type="submit" name="filtre_cat" value="Filtrer par catégorie" class="text-xl bg-lime-400 p-3 rounded-xl border-solid border-black border-2 ml-5 cursor-pointer hover:bg-lime-500">
            </form>
        </div>
    </section>



<!-- Tableau -->
    <section class="">
        <table class="flex justify-center m-10">
            <tr class=" bg-slate-400/60">
                <th class="border-solid border-2 border-black p-2.5 text-2xl">ID Favori</th>  
                <th class="border-solid border-2 border-black p-2.5 text-2xl">Libellé</th>
                <th class="border-solid border-2 border-black p-2.5 text-2xl">Date ajout</th>
                <th class="border-solid border-2 border-black p-2.5 text-2xl">Lien</th>
                <th class="border-solid border-2 border-black p-2.5 text-2xl">ID Dom</th>
                <th class="border-solid border-2 border-black p-2.5 text-2xl">Options</th>
            </tr>
            <?php 
                foreach($favoris as $favori){
                    ?>
                    <tr class="hover:bg-slate-300 odd:bg-slate-100 even:bg-slate-200">
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-center text-lg"><?php echo "$favori[id_fav]";?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-lg"><?php echo "$favori[libelle]";?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-center text-lg"><?php echo "$favori[date_creation]";?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-lg"><?php echo "<a href='".$favori['url']."' target='about_blank'class='text-teal-500 underline'>".$favori['url']."</a>";?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-center text-lg"><?php echo "$favori[id_dom]";?></td>
                        <td class="border-solid border-2 border-black p-2.5 text-center">
                            <button type="submit" name="options" value="del" class=""><img src="images/pen-to-square-regular.svg" alt="edit_icon" width="35px" class="bg-yellow-300 rounded-lg p-1"/></button>
                            <button type="submit" name="options" value="edit" class=""><img src="images/trash-can-regular.svg" alt="trash_can" width="32px"class="bg-red-500 rounded-lg p-1"/></button>
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