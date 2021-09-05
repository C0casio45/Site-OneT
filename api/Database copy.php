<?php

$dsn = "mysql:host=192.168.1.34; dbname=dbOneT";
$user = "public";
$mdp = "s329y6r5";

try
{
    $db = new PDO($dsn, $user, $mdp);
}
catch (PDOException $e)
{
    echo '<script> console.log("%c Erreur de connexion a la base de donnée. Code erreur : '.$e->getCode().'","color:red;") </script>';
}

?>