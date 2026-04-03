<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="multiburo.css">
    <!-- Lien vers le fichier de fonction PHP -->
    <?php include_once 'function.inc.php'; ?>
    <!-- Lien vers le fichier model PHP -->
    <?php include_once 'modele.inc.php'; ?>
    <!-- Lien vers le fichier de constantes PHP -->
    <?php include_once 'db.inc.php'; ?>

</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form action="inscription.php" method="post">
            <fieldset>
                <legend>Obligatoire</legend>
                    <div>
                        <label for="nom">Nom</label>
                        <input type="text" name="nom"><br>
                    </div>
                    <div>
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom"><br>
                    </div>
                    <div>
                        <label for="ID">ID</label>
                        <input type="number" name="ID"><br>
                    </div>
                    <div>
                        <input type="submit">
                    </div>
            </fieldset>
        </form>
        <fieldset>
            <legend>Inutile</legend>
            <select name="Couleur">
                <option value="cyan">Cyan</option>
                <option value="red">Rouge</option>
                <option value="green">Vert</option>
            
        </fieldset>
        <div><button onclick='fondGamble();'>Gambling</button></div>
    </div>
    <script src="function.inc.js"></script>
</body>
</html>