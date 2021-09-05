<?php
$link = '<link rel="stylesheet" href="assets/css/ticket.css">';
include 'assets/template/navbar/navbar.php';
if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
?>
<section class="centered">
    <a class="bt" href="ticket_page.php" id="btn">Mes Tickets</a>
    <h2>Formulaire de création de ticket</h2>
    <p>Merci de remplir le formulaire ci-dessous pour nous adresser un ticket</p>
    <form method="POST" action="assets/php/ticket_process.php">
        <label for="type">Type du ticket</label>
            <select type="text" name="type" onclick="display();" id="type" >
                <option value="1">Report</option>
                <option value="2">Aide</option>
                <option value="3">Demande Unban</option>
            </select>
        <div id="container_acc">
            <label for="url_faceit_acc">Url faceit de l'accusé</label>
            <div class="accuse">
                <input class="acc" type="text" name="url_faceit_acc[0]"/>
                <a href="javascript:void(0);" class="add" onclick="addAccuse();">+</a>
            </div>
        </div>
        <label for="url_faceit_game" id="url_faceit_game_l">Url faceit de la partie</label>
            <input type="text" name="url_faceit_game" id="url_faceit_game" />
        <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" rows="10" cols="30"></textarea>
        <div class="btn">
        <input type="submit" name="submit" value="Envoyer le formulaire">
        <input type="reset" value="Réinitialiser le formulaire">
        </div>
    </form>
</section>
<script src="assets/js/ticket.js"></script>
<?php 
} else { 
?>
    <section class="centered">
        <p class="qct">Vous devez être connecté pour pouvoir créer un ticket</p>
    </section>
<?php 
}
include 'assets/template/foot/foot.php';

?> 