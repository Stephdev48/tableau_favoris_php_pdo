<?php

/*on récupère les constantes de connexion définies dans connect.php*/
require("connect.php");

$dsn="mysql:dbname=".BASE.";host=".SERVER;

try{
/*connexion à la base de données*/
    $pdo=new PDO($dsn,USER,PASSWD);
} catch(PDOException $e){
    echo "Echec de la connexion: %s\n" .$e->getMessage();
    exit();
}
echo "<p class='text-center'>( Connexion réussie à la base de données ! )</p>";



// //connexion à la BDD
// $pdo = new PDO('mysql:host=localhost;dbname=favoris', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));



//affiche toutes les méthodes PDO
/*echo '<pre>'; print_r($pdo); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($pdo)); echo '</pre>'; */

?>