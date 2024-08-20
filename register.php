<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $genre = $_POST['genre'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = 0; // Rôle par défaut en tant que client

    $stmt = $conn->prepare("INSERT INTO users (genre, nom, prenom, adresse, telephone, email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $genre, $nom, $prenom, $adresse, $telephone, $email, $password, $role);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Créer un compte</h1>
        <form action="register.php" method="POST">
            <label for="genre">Genre:</label>
            <select id="genre" name="genre" required>
                <option value="M">Monsieur</option>
                <option value="F">Madame</option>
            </select>

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" required>

            <label for="telephone">Téléphone:</label>
            <input type="text" id="telephone" name="telephone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Créer un compte">
        </form>
    </div>
</body>
</html>
