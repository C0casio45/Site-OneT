<?php
include "Database.php";
session_start();
if(isset($_POST['save'])){
    if(fileValidator($_FILES["filename"])){
        $fileName = $_FILES["filename"]["name"];
        $fileExp = explode(".",$fileName);
        $fileExt = strtolower(end($fileExp));
        $fileNameNew = uniqid('', true).".".$fileExt;  //nom de notre image (son nom est un id unique)
        $fileDestination = '../../uploads/users/'.$fileNameNew;
        $_SESSION['pp'] = "uploads/users/".$fileNameNew;
        move_uploaded_file($_FILES["filename"]["tmp_name"],$fileDestination); // Enregistrement de l'image sur le serveur 
        $rqt = "CALL `dbOneT`.`Update`(:pseudo,:picture,:mail);";
        try
            {
                $query = $db->prepare($rqt);
                $query->bindParam(':pseudo',$_SESSION['login'],PDO::PARAM_STR, 45);
                $query->bindParam(':picture',$fileNameNew,PDO::PARAM_STR, 45);
                $query->bindParam(':mail',$_POST['mail'],PDO::PARAM_STR, 50);
                $query->execute();
                echo "done";
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '?sucess');
            }
            catch (PDOException $e)
            {
                echo '<script> console.log("%c Une erreur est survenue (1). Code erreur : '.$e->getCode().'","color:red;") </script>';
            }
    } else{echo '<script> console.log("%c File error (type, size or integrity)","color:red;") </script>';}
}

function fileValidator($file){
    $fileName = $file["name"];
    $fileExp = explode(".",$fileName);
    $fileExt = strtolower(end($fileExp));
    $allowed = array('jpg','jpeg','png');
    if(in_array($fileExt,$allowed) && $file["error"] === 0 && $file["size"] < 1000000){
        return true;
    }
    return false;
}
?>