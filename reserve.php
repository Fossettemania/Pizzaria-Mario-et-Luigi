<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver une table</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Réserver une table</h1>
        <form action="reserve.php" method="POST">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="telephone">Téléphone:</label>
            <input type="text" id="telephone" name="telephone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="heure">Heure:</label>
            <input type="time" id="heure" name="heure" required>

            <label for="personnes">Nombre de personnes:</label>
            <input type="number" id="personnes" name="personnes" required>

            <input type="submit" value="Réserver">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $telephone = $_POST['telephone'];
            $email = $_POST['email'];
            $date = $_POST['date'];
            $heure = $_POST['heure'];
            $personnes = $_POST['personnes'];

            $stmt = $db->prepare("INSERT INTO reservations (user_id, date, heure, personnes) VALUES (?, ?, ?, ?)");
            $stmt->execute([1, $date, $heure, $personnes]); // 1 est utilisé ici comme un ID de test pour un utilisateur existant

            echo "<p>Réservation réussie !</p>";
        }
        ?>
    </div>
</body>
</html>
