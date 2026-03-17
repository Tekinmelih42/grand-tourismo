<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['id_client'])) {
    header("Location: login.php");
    exit;
}

$message = "";

// récupérer les véhicules disponibles
$stmtVehicules = $pdo->query("SELECT id_vehicule, marque, modele, prix_jour FROM vehicule WHERE disponible = 1");
$vehicules = $stmtVehicules->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_client = $_SESSION['id_client'];
    $id_vehicule = $_POST['id_vehicule'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    if (!empty($id_vehicule) && !empty($date_debut) && !empty($date_fin)) {
        if ($date_fin > $date_debut) {
            // récupérer le prix du véhicule
            $stmtPrix = $pdo->prepare("SELECT prix_jour FROM vehicule WHERE id_vehicule = :id_vehicule");
            $stmtPrix->execute([':id_vehicule' => $id_vehicule]);
            $vehicule = $stmtPrix->fetch();

            if ($vehicule) {
                $debut = new DateTime($date_debut);
                $fin = new DateTime($date_fin);
                $nb_jours = $debut->diff($fin)->days;
                $total_estime = $nb_jours * $vehicule['prix_jour'];

                $sql = "INSERT INTO reservation (id_client, id_vehicule, date_debut, date_fin, statut, total_estime)
                        VALUES (:id_client, :id_vehicule, :date_debut, :date_fin, 'en_attente', :total_estime)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':id_client' => $id_client,
                    ':id_vehicule' => $id_vehicule,
                    ':date_debut' => $date_debut,
                    ':date_fin' => $date_fin,
                    ':total_estime' => $total_estime
                ]);

                $message = "Réservation enregistrée avec succès.";
            }
        } else {
            $message = "La date de fin doit être après la date de début.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réserver un véhicule</title>
</head>
<body>
    <h1>Réserver un véhicule</h1>

    <?php if (!empty($message)) : ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>Véhicule :</label>
        <select name="id_vehicule" required>
            <option value="">Choisir un véhicule</option>
            <?php foreach ($vehicules as $vehicule) : ?>
                <option value="<?php echo $vehicule['id_vehicule']; ?>">
                    <?php echo htmlspecialchars($vehicule['marque'] . ' ' . $vehicule['modele'] . ' - ' . $vehicule['prix_jour'] . ' €/jour'); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Date de début :</label>
        <input type="date" name="date_debut" required><br><br>

        <label>Date de fin :</label>
        <input type="date" name="date_fin" required><br><br>

        <button type="submit">Réserver</button>
    </form>
</body>
</html>