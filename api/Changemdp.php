<?php
session_start();
include 'Database.php';

if(isset($_POST['submit'])){
    if($_POST['Mot_de_passe'] == $_POST['conf_mdp'])
    {
        $nmdp = password_hash($_POST['Mot_de_passe'],PASSWORD_BCRYPT,["cost" => 14]);
    
        $srqt = "CALL `dbOneT`.`Change_mdp`(:pseudo, :new);";
        $trqt = "CALL `dbOneT`.`Connexion`(:pseudo);";
    
        try
        {
            $query = $db->prepare($trqt);
            $query->bindParam(':pseudo',$_SESSION['login'],PDO::PARAM_STR, 45);
            $query->execute();
            foreach($query as $row){
                $pwd = $row['password'];
            }

            if(password_verify($_POST['oldmdp'],$pwd) == 1){
                $query->closeCursor();
                try
                {
                    $query = $db->prepare($srqt);
                    $query->bindParam(':pseudo',$_SESSION['login'],PDO::PARAM_STR, 45);
                    $query->bindParam(':new',$nmdp,PDO::PARAM_STR, 255);
                    $query->execute();
                    
                }
                catch (PDOException $e)
                {
                    echo '<script> console.log("%c Une erreur est survenue (2). Code erreur : '.$e->getCode().'","color:red;") </script>';
                }
                $query->closeCursor();
            }
            
        }
        catch (PDOException $e)
        {
            echo '<script> console.log("%c Une erreur est survenue (1). Code erreur : '.$e->getCode().'","color:red;") </script>';
        }
        

        
        header('Location: http://www.onetfr.fr/');  
    }
    else
    {
    echo '<script> console.log("%c Les mots de passes ne sont pas identiques","color:red;") </script>';
    }
    
}