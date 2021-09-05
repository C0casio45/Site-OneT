<?php
include "Database.php";
session_start();
$rqt = "CALL `dbOneT`.`See_My_Ticket_ad`(:id);";
try
{
    $query = $db->prepare($rqt);
    $query->bindParam(':id',$_SESSION['id'],PDO::PARAM_STR, 45);
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