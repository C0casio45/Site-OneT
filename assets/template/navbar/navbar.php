<?php 
function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

if ( is_session_started() === FALSE ) session_start();

if(isset($_COOKIE['stayconnected'])){
    include_once "assets/php/Database.php";
    $rqtb = "CALL `dbOneT`.`Get_User_By_Token`(:var);";

    try
    {
        $query = $db->prepare($rqtb);
        $query->bindParam(':var',$_COOKIE['stayconnected'],PDO::PARAM_STR, 45);
        $query->execute();
        foreach($query as $row){
            $_SESSION['id'] = $row['idUsers'];
            $_SESSION['login'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['pp'] = "uploads/users/".$row['pp'];
            $_SESSION['create'] = $row['dateCreation'];
            $_SESSION['idDroit'] = $row['idDroits'];
            $_SESSION['droit'] = $row['Type_Droits'];
            $_SESSION['logged'] = true;
            $query->closeCursor();
        }
        echo '<script> console.log("%c sah quel plaisir les cookies","color:red;") </script>';
    }
    catch (PDOException $e)
    {
        echo '<script> console.log("%c Une erreur est survenue. Code erreur : '.$e->getCode().'","color:red;") </script>';
    }
    $query->closeCursor();

    $_SESSION['popup'] = true;

}

if (!isset($_SESSION['popup']) || $_SESSION['popup']== false){
    include 'assets/template/loader/load.html';
    echo "
    <article id=\"popup\">
    <h2>Ce site n'utilise des cookies ! &#x1F36A</h2>
    <p>Toutes les données sur ce sites sont sauvegardées a des fins de statistiques, historique. Aucune donnée n'est partagée ni revendu.</p>
    <p>Bonne navigation sur notre site</p>
    <a href=\"assets/php/popup.php\">Ok mec</a>
    <a href=\"legal.php\">En savoir plus</a>
    </article>
    ";
    
}

$page = basename($_SERVER["PHP_SELF"]);
$acc = '';
$tic = '';
$sout = '';
$abo = '';
$das = '';
if($page == "index.php"){
    $acc = 'class="current"';
} elseif($page == "ticket.php"){
    $tic = 'class="current"';
} elseif($page == "help.php"){
    $sout = 'class="current"';
} elseif($page == "about.php"){
    $abo = 'class="current"';
} elseif($page == "dashboard.php"){
    $das = 'class="current"';
}

?>
<!DOCTYPE html>
<html lang=fr>
    <head>
        <title>OneT Community</title>
        <meta charset="UTF-8">
        <meta name="description" content="L’une des communautés CSGO sur FaceiT la plus active avec un hub permettant la création de lobby afin de trouver des joueurs francophones et donc, d’éviter les solosQ.">
        <meta name="keywords" content="Community, CS:GO, Counter Strike">
        <meta name="robots" content="noindex,nofollow">
        <meta name="google-site-verification" content="GyewgkzVw-oZ4xPg1mmrSND1Oqxu7GSl2vAwhT_UIZ8" />
        <link rel="shortcut icon" type="image/png" href="assets/data/logo_f.png">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/4ffa61d500.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/template/navbar/navbar.css" media='screen and (min-width: 800px)' rel="stylesheet">
        <link rel='stylesheet' media='screen and (max-width: 800px)' href='assets/template/navbar/navburger.css' />
        <link href="assets/template/foot/foot.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/load.css">
        <?php echo $link ?>
        
    </head>
    <body id="page-container">
        
        <main id="content-wrap">
            <header>
                <img id="logo" src="assets/data/logo_f.png" alt="logo"/>
                <nav>
                    <div id="menuToggle">
                
                        <input class="hmbr" type="checkbox" onclick="ischecked()"/>
                
                        <span class="hmbr"></span><span class="hmbr"></span><span class="hmbr"></span>

                        <ul id="menu">
                            <li><a href="index.php" <?php echo $acc ?>>Accueil</a></li>
                            <li><a href="ticket.php" <?php echo $tic ?>>Ticket</a></li>
                            <li><a href="help.php" <?php echo $sout ?>>Nous soutenir</a></li>
                            <li><a href="about.php" <?php echo $abo ?>>A Propos</a></li>
                            <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true && $_SESSION['idDroit'] >= 2){ ?>
                            <li><a href="dashboard.php" <?php echo $das ?>>Dashboard</a></li>
                            <?php } ?>
                            <?php if(isset($_SESSION['logged']) == true) { ?>
                            <li id="isconnected">Bonjour <?php echo $_SESSION['login'] ?></li>
                            <li id="isconnected"><a href="profil.php">Mon Profil</a></li>
                            <li id="isconnected"><a href="assets/php/Deconnexion.php">Se déconnecter</a></li>
                            <?php } else {?>
                            <li class="isconnected"><a href="Sign.php?connexion">Connexion</a></li>
                            <li class="isconnected"><a href="Sign.php?inscription">Inscription</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
                <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) { ?>
                    <div id="signed">
                        <div id="btsc">
                            <a href="profil.php">Mon Profil</a>
                            <a href="assets/php/Deconnexion.php">Se déconnecter</a>
                        </div>
                        <figure>
                            <img src="<?php echo $_SESSION['pp'] ?>" alt="Photo de profile"/>
                            <figcaption id="pseudo"><?php echo $_SESSION['login'] ?></figcaption>
                        </figure>
                    </div>
                <?php } else { ?>
                    <div id="btsn">
                        <a href="Sign.php?connexion">Connexion</a>
                        <a href="Sign.php?inscription">Inscription</a>
                    </div>
                <?php } ?>
            </header>
            