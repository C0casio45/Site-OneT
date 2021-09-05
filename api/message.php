<?php
include "Database.php";
$rqt = "call dbOneT.Get_Ticket_Message(:id);";
$arr = "";
$i = 0;
try
{
    $query = $db->prepare($rqt);
    $query->bindParam(':id',$id,PDO::PARAM_STR, 45);
    $query->execute();

    foreach($query as $row){
        if ($i > 0) {$arr .= ",";}
        $username = htmlspecialchars($row['username']);
        $idMessage = htmlspecialchars($row['idMessage']);
        $DateEnvoie = htmlspecialchars($row['DateEnvoie']);
        $content = htmlspecialchars($row['content']);
        $arr .= '"'.$username.'","'.$idMessage.'","'.$DateEnvoie.'","'.$content.'"';
        $i++;
    }
    echo '<script>let messages = ['.$arr.']</script>';
}
catch (PDOException $e)
{
    echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
}
$query->closeCursor();

?>

