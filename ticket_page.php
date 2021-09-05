<?php
$link='<link rel="stylesheet" href="assets/css/message.css">';
include "assets/php/Database.php";
include "assets/template/navbar/navbar.php";
if(isset($_GET["id"])){
    $id = $_GET["id"];  
    include "assets/php/ticket_info.php";
    include "assets/php/message.php";
    $_SESSION["idT"] = $id;
?>

<div id="infos">
</div>

<div id="messages">
</div>

<?php if($Status < 2){ ?>

    <div class="bottom">
        <?php if($_SESSION["idDroit"] > 1){ ?>
        <input type="submit" name="close" onclick="affForm()" id="close" value="" >
        <?php } ?>
        <form action="assets/php/Send_Message.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <div id="imgcont">
                <input onchange="updateImageDisplay(this)" type="file" name="clue"  id="img" accept=".png,.jpg,.jpeg">
                <div id="imgprev" hov="url('../data/img.svg')" ></div>
            </div>
            <input type="text" name="message" id="message">
            <input type="submit" name="submit" value="" id="send">
        </form>
    </div>
    <?php if($_SESSION["idDroit"] > 1){ ?>
    <form action="assets/php/Close_Ticket.php?id=<?php echo $id ?>" method="post" id="formEnd" >
            <span onclick="hideForm()" class="delete">X</span>
            <div><input type="radio" name="type" id="AVERTISSEMENT" value="AVERTISSEMENT"><label for="AVERTISSEMENT">AVERTISSEMENT</label></div>
            <div><input type="radio" name="type" id="TEMPBAN" value="TEMPBAN"><label for="TEMPBAN">TEMPBAN</label></div>
            <div><input type="radio" name="type" id="BAN" value="BAN"><label for="BAN">BAN</label></div>
            <div><input type="text" name="reason" id="reason" placeholder="raison"><label for="reason">Raison</label></div>
            <div>
                <input type="number" name="num" id="num" value="0">
                <select name="duree" id="duree">
                    <option value="">Merci de choisir une option</option>
                    <option value="heure">heure</option>
                    <option value="jour">jour</option>
                    <option value="semaine">semaine</option>
                    <option value="mois">mois</option>
                    <option value="année">année</option>
                </select>
            </div>
            <input type="submit" name="close" value="Clore le ticket" id="end">
            <input type="reset" name="back" value="Annuler" id="back">
    </form>
<?php } } ?>

<script src="assets/js/message.js"></script>
<?php
}
else {
?>

<div id="my">
    <h2>Mes Tickets</h2>
</div>
<script src="assets/js/my_ticket.js"></script>
<?php
}
include "assets/template/foot/foot.php"
?>