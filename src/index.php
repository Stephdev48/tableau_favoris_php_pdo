<?php

    include("header.php");

    include("pdo.php");

    // Affichage (SELECT) :
$result = $pdo->query("SELECT * FROM favori");
$favoris = $result->fetchAll(PDO::FETCH_ASSOC);

//affiche toutes les lignes
// echo "<pre>"; print_r($favoris); echo "</pre>";

?>

    <section class="">
        <table class="flex justify-center m-7">
            <tr class=" bg-slate-300/60">
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
            <tr class="hover:bg-slate-200">
                <td class="border-solid border-2 border-black p-2.5 font-bold text-center "><?php echo "$favori[id_fav]";?></td>
                <td class="border-solid border-2 border-black p-2.5 font-bold"><?php echo "$favori[libelle]";?></td>
                <td class="border-solid border-2 border-black p-2.5 font-bold"><?php echo "$favori[date_creation]";?></td>
                <td class="border-solid border-2 border-black p-2.5 font-bold"><?php echo "$favori[url]";?></td>
                <td class="border-solid border-2 border-black p-2.5 font-bold text-center"><?php echo "$favori[id_dom]";?></td>
                <td class="border-solid border-2 border-black p-2.5">
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