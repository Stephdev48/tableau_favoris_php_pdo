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
?>



<!-- Affichage résultat de la recherche -->
<fieldset class="flex justify-center p-6 items-center border-solid border-black border-2 bg-stone-300 m-8 rounded-2xl">
    <legend class="text-xl md:text-2xl font-bold bg-black p-3 rounded-lg border-solid border-black border-2 text-white">Résultat de la recherche</legend>
    <table class="flex justify-center m-6">
            <tr class=" bg-slate-400/60"> 
                <th class="border-solid border-2 border-black p-2 text-base lg:text-2xl">Libellé</th>
                <th class="border-solid border-2 border-black p-2 text-base lg:text-2xl">Lien</th>
                <th class="border-solid border-2 border-black p-2 text-base lg:text-2xl">Afficher</th>
                <th class="border-solid border-2 border-black p-2 text-base lg:text-2xl">Options</th>
            </tr>
            <?php 
                foreach($result_search as $mon_result){
                    ?>
                    <tr class="hover:bg-slate-300 odd:bg-slate-100 even:bg-slate-200">
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-sm lg:text-2xl">
                            <?php echo $mon_result["libelle"];?>
                        </td>
                        <td class="border-solid border-2 border-black p-2.5 font-bold text-sm lg:text-2xl">
                            <?php echo "<a href='".$mon_result['url']."' target='about_blank'><img src='images/link-solid.svg' width='35px' class='bg-teal-400 hover:bg-teal-500 rounded-lg p-1 2xl:hidden'/></a>";?>
                            <span class="ml-4 hidden 2xl:contents"><?php echo "<a href='".$mon_result['url']."' target='about_blank'class='text-teal-500 underline'>".$mon_result['url']."</a>";?></span></td>
                        <td class="border-solid border-2 border-black text-center">
                            <button type="submit" name="see" value="see"><a href="seeFavori.php?id=<?php echo $mon_result["id_fav"]?>" target='_blank'><img src="images/eye-regular.svg" alt="see_icon" width="35px" class="bg-violet-400 rounded-lg p-1"/></a></button>
                        </td>
                        <td class="border-solid border-2 border-black p-2.5 text-center">
                            <div class="flex justify-center items-center">
                                <?php echo "<a href='update.php?id=".$mon_result["id_fav"]."'><img src='images/pen-to-square-regular.svg' alt='edit_icon' width='35px' class='bg-yellow-300 hover:bg-yellow-500 rounded-lg p-1'/></a>";
                                ?>
                                <?php echo "<a href='delete.php?id_del=".$mon_result['id_fav']."' class='ml-2'><img src='images/trash-can-regular.svg' alt='delete_icon' width='32px' class='bg-red-500 hover:bg-red-700 rounded-lg p-1'/></a>";
                                ?>
                            </div>
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