<?php
include "Database.php";
$rqt = "CALL dbOneT.Close_Ticket(:id,:Sanction,:Reason);";
if(isset($_POST['type'])){
$return = $_POST['num'].' '.$_POST['duree'].' '.$_POST['type'];
}else{$return = "0";}
if(isset($_POST['reason'])){
$rson = $_POST['reason'];
}else{$rson = "Classé sans suite";}
try
{
    $query = $db->prepare($rqt);
    $query->bindParam(':id',$_GET['id'],PDO::PARAM_STR, 45);
    $query->bindParam(':Sanction',$return,PDO::PARAM_STR, 45);
    $query->bindParam(':Reason',$rson,PDO::PARAM_STR, 45);
    $query->execute();
    header('Location: http://www.onetfr.fr/ticket_page.php&success');
}
catch (PDOException $e)
{
    echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
}
$query->closeCursor();
?>