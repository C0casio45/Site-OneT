<?php
include "Database.php";
$rqt = "call dbOneT.Get_Ticket(:id);";
$arr = "";
try
{
    $query = $db->prepare($rqt);
    $query->bindParam(':id',$id,PDO::PARAM_STR, 45);
    $query->execute();
    foreach($query as $row){
        $idTicket = htmlspecialchars($row['idTicket']);
        $Status = htmlspecialchars($row['Status']);
        $FaceitGame = htmlspecialchars($row['FaceitGame']);
        $Ouverture = htmlspecialchars($row['Ouverture']);
        $Fermeture = htmlspecialchars($row['Fermeture']);
        $Sanction = htmlspecialchars($row['Sanction']);
        $Pseudo = htmlspecialchars($row['Accuse']);
        $LienFaceit = htmlspecialchars($row['LienAccuse']);
        $Type = htmlspecialchars($row['Type']);
        $Users_id = htmlspecialchars($row['Users_id']);
        $Users_id_Admin = htmlspecialchars($row['Users_id_Admin']);
        $arr = '"'.$idTicket.'","'.$Status.'","'.$FaceitGame.'","'.$Ouverture.'","'.$Fermeture.'","'.$Sanction.'","'.$Pseudo.'","'.$LienFaceit.'","'.$Type.'","'.$Users_id.'","'.$Users_id_Admin.'"';
    }
    echo '<script>let infoTicket = ['.$arr.']</script>';
}
catch (PDOException $e)
{
    echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
}
$query->closeCursor();

?>
