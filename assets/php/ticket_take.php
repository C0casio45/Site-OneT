<?php
    echo "Redirection en cours";
    session_start();
    include 'Database.php';
    $idticket = $_GET['id'];
    $user = $_SESSION['id'];
    $droit = $_SESSION['idDroit'];

    echo $droit;

    if(isset($droit) && $droit > 1){
        $rqt = "CALL `dbOneT`.`Take_Ticket`(:idu,:idt);";
        try
        {
            $query = $db->prepare($rqt);
            $query->bindParam(':idu',$user,PDO::PARAM_STR, 45);
            $query->bindParam(':idt',$idticket,PDO::PARAM_STR, 45);
            $query->execute();

            echo '<script> console.log("Ticket pris avec succès") </script>';
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        catch (PDOException $e)
        {
            echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
        }
        $query->closeCursor();
    }

    
?>