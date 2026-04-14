<?php
session_start();
require_once 'config/db.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT id_client, nom, prenom, email, mot_de_passe FROM client WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);

    $client = $stmt->fetch();

    if ($client && password_verify($mot_de_passe, $client['mot_de_passe'])) {
        $_SESSION['id_client'] = $client['id_client'];
        $_SESSION['nom'] = $client['nom'];
        $_SESSION['prenom'] = $client['prenom'];

        header("Location: reserver.php");
        exit;
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php if (!empty($message)) : ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>Email :</label>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe :</label>
        <input type="password" name="mot_de_passe" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>