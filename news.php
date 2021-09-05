<?php
$link = "";
include 'assets/template/navbar/navbar.php'
?>

            <form method="POST" action="data.php">
            titre :
                <input type="text" name="titre" readonly>
            Autheur :
                <input type="text" name="author" readonly>
            lien de l'Image :
                <input type="text" name="linkimg" readonly>
            contenu
                <input type="text" name="content" readonly>
            </form>

<?php include 'assets/template/foot.php' ?> 