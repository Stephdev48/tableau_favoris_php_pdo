<!-- Inclusion header et fichier pdo -->
<?php
    include("header.php");
    include("pdo.php");
    ?>


<!-- Requête de recherche -->
<?php
    $req_search = ("SELECT * FROM favori WHERE libelle LIKE '%".$_GET['terme']."%';");
    $search = $pdo->query($req_search);
    $result_search = $search->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($result_search);
    // echo "</pre>";
    // $keys = array_keys($result_search);
    // echo "<pre>";
    // print_r($keys);
    // echo "</pre>";
    ?>



<!-- Affichage résultat de la recherche -->
<fieldset class="flex justify-center p-10 items-center border-solid border-black border-2 bg-indigo-300 m-20 rounded-2xl">
    <legend class="text-3xl font-bold bg-slate-400 p-3 rounded-lg border-solid border-black border-2">Résultat de la recherche</legend>
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
                foreach($result_search as $mon_result){
                    ?>
                    <tr class="hover:bg-slate-300 odd:bg-slate-100 even:bg-slate-200">
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-center text-lg"><?php echo $mon_result["id_fav"];?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-center text-lg"><?php echo $mon_result["id_dom"];?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-lg"><?php echo $mon_result["libelle"];?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-center text-lg"><?php echo $mon_result["date_creation"];?></td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-lg"><?php echo "<a href='".$mon_result['url']."' target='about_blank'class='text-teal-500 underline'>".$mon_result['url']."</a>";?></td>
                        <td class="border-solid border-2 border-black p-2.5 text-center">
                            <button type="submit" name="see" value="see"><a href="seeFavori.php?id=<?php echo $mon_result["id_fav"]?>" target='_blank'><img src="images/eye-regular.svg" alt="see_icon" width="35px" class="bg-violet-400 rounded-lg p-1"/></a></button>
                        </td>
                        <td class="border-solid border-2 border-black p-2.5 text-center">
                            <button type="submit" name="options" value="edit"><img src="images/pen-to-square-regular.svg" alt="edit_icon" width="35px" class="bg-yellow-300 rounded-lg p-1"/></button>
                            <button type="submit" name="options" value="del"><img src="images/trash-can-regular.svg" alt="trash_can" width="32px"class="bg-red-500 rounded-lg p-1"/></button>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
</fieldset>




<!-- Inclusion footer -->
<?php
    include("footer.php");
    ?>