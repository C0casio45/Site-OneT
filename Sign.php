<?php 
    $link = '<link href="assets/css/sign.css" rel="stylesheet" type="text/css">
    <script src="assets/js/conf_mdp.js"></script>';
    include 'assets/template/navbar/navbar.php';
    if(isset($_GET['connexion'])){$t='connexion';}
    if(isset($_GET['inscription'])){$t='inscription';}
    else{$t='connexion';}
    echo '<script type="text/javascript">let state = "'.$t.'"</script>';
?>
<section class="centered">
    <div id="switch">
        <div id="box"></div>
        <div class="txt" onclick="alt();">
            <p>Connexion</p>
            <p>Inscription</p>
        </div>
    </div>
    <div id="Sign_up">
        <form method="POST" action="assets/php/Inscription.php">
            <label for="pseudo">Votre Pseudo</label><br/>
                <input type="text" name="pseudo" id="login" required/><br/>
            <label for="Mot_de_passe">Mot de passe</label><br/>
                <input type="password" name="Mot_de_passe" id="inpassword" title="1 Nombre, 1 Majuscule, 1 Minuscule, 1 Caractère spéciale" placeholder="10 caractères minimum" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{10,}$" required/><br/>
            <label for="conf_mdp">Confirmation du mot de passe</label>
                <input type="password" name="conf_mdp" id="conf_mdp">
            <label for="email">Votre Email</label><br/>
                <input type="email" name="email" id="mail" pattern="(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*)@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])" required><br/>
            <input type="submit" name="submit" id="inscrip" value="Créer un compte">
        </form>
    </div>
    <div id="Sign_in">
        <form method="POST" action="assets/php/Connexion.php" >
            <label for="email">Votre E-Mail</label><br/>
                <input type="text" name="email" id="mail" /><br/>
            <label for="Mot_de_passe">Mot de passe</label><br/>
                <input type="password" name="Mot_de_passe" id="password" /><br/>    
            <span>
                <input type="checkbox" name="stayconn" id="stayconn"/>
                <label for="stayconn">Rester connecté</label>
            </span><br/>
            <input type="submit" name="submit" value="Connexion">
        </form>
    </div>
</section>
<script type="text/javascript" src="assets/js/sign.js"></script>

<?php include 'assets/template/foot/foot.php' ?>      