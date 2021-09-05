<?php
$link = '<link href="assets/css/dashboard.css" rel="stylesheet" type="text/css">
<script src="assets/js/dashboard.js"></script>';
include 'assets/template/navbar/navbar.php';
if(isset($_SESSION['logged']) && $_SESSION['logged'] == true && $_SESSION['idDroit'] >= 2){
?>
    <h1>Dashboard</h1>
    <div id="result">
        <div id="new">
        <h2>Nouveaux tickets</h2>
        </div>
        <div id="my">
        <h2>Mes Tickets</h2>
        </div>
        <div id="current">
        <h2>Tickets en cours</h2>
        </div>
    </div>
    <aside>
        <a class="aside" href="stats.php">Statistiques</a>
        <a class="aside" href="archives.php">Archives</a>
    </aside>
<?php 
include 'assets/template/foot/foot.php';
} else { 
?>
    <section class="qcq">
        <h1>403 : Forbidden</h1>
        <p>L'accès a cette page vous est interdit</p>
    </section>
<?php 
include 'assets/template/foot/foot.php';
}