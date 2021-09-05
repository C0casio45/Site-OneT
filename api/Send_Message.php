<?php
include "Database.php";
session_start();
$content = htmlentities($_POST['message']);
print_r($_FILES);
echo $_FILES["clue"]["size"];
if($_FILES["clue"]["size"] > 0){
    if(fileValidator($_FILES["clue"])){
        $fileName = $_FILES["clue"]["name"];
        $fileExp = explode(".",$fileName);
        $fileExt = strtolower(end($fileExp));
        $fileNameNew = uniqid('', true).".".$fileExt;  //nom de notre image (son nom est un id unique)
        $fileDestination = '../../uploads/ticket/'.$fileNameNew;
        $filePosition = "uploads/ticket/".$fileNameNew;
        move_uploaded_file($_FILES["clue"]["tmp_name"],$fileDestination); // Enregistrement de l'image sur le serveur 
        $content .= ' ||'.$filePosition;
        //send($db,$content);
        
    } else{echo '<script> console.log("%c File error (type, size or integrity)","color:red;") </script>';}
}else{
    //send($db,$content);
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

function send($db,$content){
    $rqt = "CALL `dbOneT`.`Send_Message`(:idU, :idT, :content);";
    try
    {
        $query = $db->prepare($rqt);
        $query->bindParam(':idU',$_SESSION['id'],PDO::PARAM_STR, 45);
        $query->bindParam(':idT',$_SESSION['idT'],PDO::PARAM_STR, 45);
        $query->bindParam(':content',$content,PDO::PARAM_STR, 500);
        $query->execute();
        echo '<article> Message envoyé avec succès </article>';
        //header('Location: ' . $_SERVER['HTTP_REFERER'] . '&success');
    }
    catch (PDOException $e)
    {
        echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
    }
    $query->closeCursor();
}