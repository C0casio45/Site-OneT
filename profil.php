<?php
$link = '<link href="assets/css/profil.css" rel="stylesheet" type="text/css">
<script src="assets/js/conf_mdp.js"></script>';
include 'assets/template/navbar/navbar.php';
if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
?>

    <section class="centered">
        <div id="ppcont"><img src="<?php echo $_SESSION['pp'] ?>" alt="Photo de profil"></div>
        <form action="assets/php/picNickMailChange.php" method="POST" enctype="multipart/form-data">
            <div id="FileWrapper" data-before="Select your profile picture"><input type="file" id="myFile" name="filename" value="" accept=".png,.jpg,.jpeg,."></div>
            <label for="login">Pseudo</label>
            <input type="text" name="login" id="pseudo" value="<?php echo $_SESSION['login'] ?>">
            <label for="mail">Email</label>
            <input type="text" name="mail" id="email" value="<?php echo $_SESSION['email'] ?>">
            <input type="submit" name="save" value="Enregistrer" id="save">
        </form>
        <p>Niveau de droit : <?php echo $_SESSION['droit'] ?></p>
        <p>Date de création du compte : <?php echo date("d/m/Y",strtotime($_SESSION['create'])) ?></p>
        <a class="bt" href="#" onclick="affForm();" id="btn">Changer de mot de passe</a>
        <form action="assets/php/Changemdp.php" method="post" id="ff">
            <label for="oldmdp">Ancien mot de passe</label>
            <input type="password" name="oldmdp" id="oldmdp" required>
            <label for="newmdp">Nouveau mot de passe</label>
            <input type="password" name="Mot_de_passe" id="inpassword" title="1 Nombre, 1 Majuscule, 1 Minuscule, 1 Caractère spéciale" placeholder="10 caractères minimum" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{10,}$" required>
            <label for="confnewmdp">Confirmation du nouveau mot de passe</label>
            <input type="password" name="conf_mdp" id="conf_mdp" required>
            <input type="submit" name="submit" value="Confirmer" id="inscrip">
        </form>
    </section>
    <script src="assets/js/profil.js"></script>    
<?php 
} else { 
?>
    <section class="centered">
        <p>Vous devez être connecté pour pouvoir accéder a votre profile</p>
    </section>
<?php 
}
include 'assets/template/foot/foot.php';
?> 

