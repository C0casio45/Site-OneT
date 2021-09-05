<?php
session_start();
include 'Database.php';


if(isset($_POST['submit'])){
    if($_POST['Mot_de_passe'] == $_POST['conf_mdp'])
    {
        $_SESSION['login'] = htmlentities($_POST['pseudo']);

        $mdp = password_hash($_POST['Mot_de_passe'],PASSWORD_BCRYPT,["cost" => 14]);
    
        $rqt = "CALL `dbOneT`.`Inscription`(:pseudo , :mail , :mdp);";
    
        try
        {
            $query = $db->prepare($rqt);
            $query->bindParam(':pseudo',$_SESSION['login'],PDO::PARAM_STR, 45);
            $query->bindParam(':mail',htmlspecialchars($_POST['email']),PDO::PARAM_STR, 50);
            $query->bindParam(':mdp',$mdp,PDO::PARAM_STR, 255);
            $query->execute();
    
            
        }
        catch (PDOException $e)
        {
            echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
        }
        $query->closeCursor();
        header('Location: http://www.onetfr.fr');  
    }
    else
    {
    echo '<script> console.log("%c Les mots de passes ne sont pas identiques","color:red;") </script>';
    }
    
}