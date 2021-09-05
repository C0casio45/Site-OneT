<?php
include 'Database.php';
session_start();
if(isset($_POST['submit'])){
    
    $mdp = $_POST['Mot_de_passe'];

    //echo password_hash('test',PASSWORD_BCRYPT,["cost" => 14]);

    $rqt = "CALL `dbOneT`.`Connexion`(:mail);";

    try
    {
        $query = $db->prepare($rqt);
        $query->bindParam(':mail',$_POST['email'],PDO::PARAM_STR, 45);
        $query->execute();

        echo resultRqt($query,$mdp,$db);
    }
    catch (PDOException $e)
    {
        echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
    }
    $query->closeCursor();
}



function resultRqt($q,$m,$db){
    
    if ($q->rowCount() > 0) {
        foreach($q as $row){
            if(password_verify($m,$row['password']) == 1){
                $_SESSION['id'] = $row['idUsers'];
                $_SESSION['login'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['pp'] = "uploads/users/".$row['pp'];
                $_SESSION['create'] = $row['dateCreation'];
                $_SESSION['idDroit'] = $row['idDroits'];
                $_SESSION['droit'] = $row['Type_Droits'];
                $_SESSION['logged'] = true;
                $q->closeCursor();
                staycon($db);
                if($_SESSION['idDroit'] > 1){
                    header('Location: http://www.onetfr.fr/dashboard.php');
                } else {
                    header('Location: http://www.onetfr.fr?');
                }
                return '<article>Connecté</article>';
            }
            header('Location: http://www.onetfr.fr/Sign.php?connexion&error');
            return '<article>Login ou mot de passe incorrecte</article>';
        }
    } else {
        header('Location: http://www.onetfr.fr/Sign.php?connexion&error');
         return '<article>Login ou mot de passe incorrecte</article>';
    }
}

function staycon($db){
    if(isset($_POST['stayconn'])){
        $prefix = $_SESSION['login'][0].$_SESSION['login'][1].'_';
        $token = uniqid($prefix);
        setcookie("stayconnected",$token,time() + (86400 * 30),"/");
        $rqtb = "CALL `dbOneT`.`Get_Token`(:var, :usr);";

        try
        {
            $query = $db->prepare($rqtb);
            $query->bindParam(':var',$token,PDO::PARAM_STR, 45);
            $query->bindParam(':usr',$_SESSION['id'],PDO::PARAM_STR, 45);
            $query->execute();

            echo resultRqt($query,$mdp);
        }
        catch (PDOException $e)
        {
            echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
        }
        $query->closeCursor();

    }
}


?>