<?php

$message = "";

$conn = new mysqli("localhost:3307", "root", "", "inscription_tourismo");

if ($conn->connect_error) {
    die("Erreur connexion");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $mdp = trim($_POST['mdp']);

    // Vérifications
    if (empty($email) || empty($mdp)) {
        $message = "❌ Tous les champs sont obligatoires";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "❌ Email invalide";
    } 
    elseif (strlen($mdp) < 8) {
        $message = "❌ Mot de passe trop court (8 caractères min)";
    }
    elseif (!preg_match("/[A-Z]/", $mdp)) {
        $message = "❌ 1 majuscule requise";
    }
    elseif (!preg_match("/[0-9]/", $mdp)) {
        $message = "❌ 1 chiffre requis";
    }
    elseif (!preg_match("/[\W]/", $mdp)) {
        $message = "❌ 1 caractère spécial requis";
    }
    else {

        // 🔐 Hash du mot de passe
        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

        $sql = "INSERT INTO utilisateurs (email, password)
                VALUES ('$email', '$mdpHash')";

        if ($conn->query($sql) === TRUE) {
            $message = "Inscription réussie ✅";
        } else {
            $message = "Email déjà utilisé ❌";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <h3>Tourismo</h3>
    </div>

    <nav>
        <a href="acceuil.html">Accueil</a>
        <a href="catalogue.html">Catalogue</a>
        <a href="nos_services.html">Nos services</a>
        <a href="contact.html">Contact</a>
        <a href="localisation.html">Localisation</a>
    </nav>
</header>

<div class="inscription-page">

    <div class="boite-inscription">

        <h2>Créer un compte</h2>

        <form method="POST">

            <input type="email" name="email" placeholder="Email">

            <input type="password" name="mdp" placeholder="Mot de passe">

            <button class="btn-inscription">S'inscrire</button>

        </form>

        <p class="message"><?php echo $message; ?></p>

    </div>

</div>

</body>
</html>