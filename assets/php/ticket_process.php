<?php
include 'Database.php';
session_start();

if(isset($_POST['submit'])){

    $rqtu = "CALL `dbOneT`.`Create_Ticket`(:idU, :type, :liengame);";
    $rqtd = "CALL `dbOneT`.`Create_Ticket_Accuse`(:idT, :pseudo, :lienacc);";
    $rqtt = "CALL `dbOneT`.`Create_Ticket_Message`(:idT, :idU, :content);";

    $type = $_POST['type'];

    $IDT;

    $urlgame = htmlentities($_POST['url_faceit_game']);
    $content = htmlentities($_POST['commentaire']);

    try
    {
        $query = $db->prepare($rqtu);
        $query->bindParam(':idU',$_SESSION['id'],PDO::PARAM_STR, 45);
        $query->bindParam(':type',$type,PDO::PARAM_STR, 45);
        $query->bindParam(':liengame',$urlgame,PDO::PARAM_STR, 45);
        $query->execute();

        
        $IDT = resultRqtU($query);
    }
    catch (PDOException $e)
    {
        echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
    }
    $query->closeCursor();

    $urlacc = $_POST['url_faceit_acc'];
    foreach($urlacc as $row){
        $urlExpAcc = explode('/',$row);
        $pseudoAcc = end($urlExpAcc);
        SetAccuse($db,$rqtd,htmlentities($row),$pseudoAcc,$IDT);
    }

    try
    {
        $query = $db->prepare($rqtt);
        $query->bindParam(':idT',$IDT,PDO::PARAM_STR, 45);
        $query->bindParam(':idU',$_SESSION['id'],PDO::PARAM_STR, 45);
        $query->bindParam(':content',$content,PDO::PARAM_STR, 45);
        $query->execute();

    }
    catch (PDOException $e)
    {
        echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
    }
    $query->closeCursor();

    header('Location: ' . $_SERVER['HTTP_REFERER']);

}

function resultRqtU($q){
    
    if ($q->rowCount() > 0) {
        foreach($q as $row){
            $ticket_id = $row['last_insert_id()'];
            return $ticket_id;
        }
    } else {
         return '<article>Something went wrong</article>';
    }
}

function SetAccuse($db,$rqt,$d,$dp,$idti){
    try
    {
        $query = $db->prepare($rqt);
        $query->bindParam(':idT',$idti,PDO::PARAM_STR, 45);
        $query->bindParam(':pseudo',$dp,PDO::PARAM_STR, 45);
        $query->bindParam(':lienacc',$d,PDO::PARAM_STR, 45);
        $query->execute();

    }
    catch (PDOException $e)
    {
        echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
    }
    $query->closeCursor();
}

?>