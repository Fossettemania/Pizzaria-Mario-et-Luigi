<?php
session_start();
include 'db.php';

// Vérification que l'utilisateur est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Interface Administrateur</h1>
        <!-- Ajouter pizza -->
        <p>Modification des pizza <a href="add_pizza.php">Ajouter</a></p>
        <a href="remove_pizza.php">Supprimer</a></p>
        

    </div>
</body>
</html>
