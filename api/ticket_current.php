<?php
session_start();
include "Database.php";
$rqt = "CALL `dbOneT`.`See_Current_Ticket`();";


try
{
    $query = $db->prepare($rqt);
    $query->execute();

    $result = $query->fetchAll();

    if ($query->rowCount() > 0){
        echo json_encode($result);
    } else {
        redirectionErreur404();
    }
}
catch (PDOException $e)
{
    echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
}
$query->closeCursor();


function redirectionErreur404()
{
header('HTTP/1.0 404 Not Found');
exit;
}   
?>