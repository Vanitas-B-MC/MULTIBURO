<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation</title>
    <link rel="stylesheet" href="multiburo.css">
    <!-- Lien vers le fichier de fonction PHP -->
    <?php include_once 'function.inc.php'; ?>
    <!-- Lien vers le fichier model PHP -->
    <?php include_once 'modele.inc.php'; ?>
    <!-- Lien vers le fichier de constantes PHP -->
    <?php include_once 'db.inc.php'; ?>

</head>
<body>
    <header>
    </header>
    <div class="container">
        <h1>Liste des services</h1>
        <?php
            // *** Traitement SQL / Tableau ***
            
            // Date du jour au format YYYY-MM-DD
            // $today = date('Y-m-d');
            // Déclaration des variables
            $srch = '';            
            $tmp = '';

            // Test si validation du formulaire
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if(isset($_POST['srch']))
                {
                    $srch = $_POST['srch'];
                }
            }
            // Récuparartion du tableau des bureau
            $tmp = getListeBureau($srch);
            
        ?>
        <div class="center">
            <form action="MultiBuro.php" method="post">
                <?php
                    // *** Affichage Recherche ***
                    // Recherche
                    $argv = array();
                    $argv['name'] = 'srch';
                    $argv['type'] = 'date';
                    $argv['value'] = $srch;
                    $argv['nodiv'] = true;
                    displayInput($argv);

                    // Validation
                    $argv = array();
                    $argv['value'] = 'Rechercher';
                    $argv['type'] = 'submit';
                    $argv['nodiv'] = true;
                    displayButton($argv);
                ?>
            </form>
        </div>
        <div id="johnnyjoestar">
            <?php 
            echo $tmp; 
            ?>
        </div>
    </div>
<script src="JSfunction.inc.js"></script>
</body>
</html>