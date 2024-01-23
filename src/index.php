
<!--Inclusion des fichiers php et récupération de données dans la BDD favoris-->
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
    <section class="flex justify-center p-10 items-center border-solid border-black border-2 bg-indigo-300 m-10">
        <div class="flex items-center">
            <label class="text-3xl pr-5 font-bold">Catégories</label>
            <form>
                <select name="categories" class="text-xl border-solid border-2 border-black rounded-xl p-2 bold cursor-pointer">
                    <option value="">--Choisissez une catégorie--</option>
                    <?php 
                        foreach($categories as $categorie){
                        ?>
                        <option value="<?php echo $categorie['id_cat']?>"><?php echo $categorie['nom_cat']?></option>
                        <?php
                        }
                    ?>
                </select>
            </form>
            <div class="pl-5">
                <button class="text-2xl bg-lime-400 p-3 rounded-lg border-solid border-black border-2">Filtrer par catégorie</button>
            </div>
        </div>
    </section>


<!-- Tableau -->
    <section class="">
        <table class="flex justify-center m-7">
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
                <tr class="hover:bg-slate-200 bg-slate-100">
                    <td class="border-solid border-2 border-black p-2.5 font-bold text-center "><?php echo "$favori[id_fav]";?></td>
                    <td class="border-solid border-2 border-black p-2.5 font-bold"><?php echo "$favori[libelle]";?></td>
                    <td class="border-solid border-2 border-black p-2.5 font-bold text-center"><?php echo "$favori[date_creation]";?></td>
                    <td class="border-solid border-2 border-black p-2.5 font-bold"><?php echo "$favori[url]";?></td>
                    <td class="border-solid border-2 border-black p-2.5 font-bold text-center"><?php echo "$favori[id_dom]";?></td>
                    <td class="border-solid border-2 border-black p-2.5 text-center">
                        <button type="button" name="options" value="del" class=""><img src="images/pen-to-square-regular.svg" alt="trash-can" width="30px"/></button>
                        <button type="button" name="options" value="edit" class=""><img src="images/trash-can-regular.svg" alt="trash-can" width="30px"/></button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </section>
</body>
</html>