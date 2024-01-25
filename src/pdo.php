<?php

/*on récupère les constantes de connexion définies dans connect.php*/
require("connect.php");

/*on prépare la connexion à la base de données*/
define('SERVER',"localhost");
define('USER',"root");
define('PASSWD',"");
define('BASE',"favoris");


//connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=favoris', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));



//affiche toutes les méthodes PDO
/*echo '<pre>'; print_r($pdo); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($pdo)); echo '</pre>'; */

?>