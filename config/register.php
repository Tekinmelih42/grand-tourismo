<?php require_once 'config/db.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Créer un compte</h1>

    <form method="post" action="">
        <label>Nom :</label>
        <input type="text" name="nom" required><br><br>

        <label>Prénom :</label>
        <input type="text" name="prenom" required><br><br>

        <label>Email :</label>
        <input type="email" name="email" required><br><br>

        <label>Téléphone :</label>
        <input type="text" name="telephone"><br><br>

        <label>Numéro de permis :</label>
        <input type="text" name="num_permis" required><br><br>

        <label>Mot de passe :</label>
        <input type="password" name="mot_de_passe" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>