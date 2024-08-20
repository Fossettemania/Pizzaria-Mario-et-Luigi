<?php
// Inclure le fichier de configuration de la base de données
include 'db.php';

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom= $_POST['nom'];
    $taille = $_POST['taille'];
    $prix = $_POST['prix'];

    // Vérifier que tous les champs sont remplis
    if (!empty($nom) && !empty($taille) && !empty($prix)) {
        // Préparer et exécuter la requête d'insertion
        $sql = "INSERT INTO pizzas (nom, taille, prix) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $nom, $taille, $prix);  // 'ssd' signifie string, string, double

        if ($stmt->execute()) {
            echo "Pizza ajoutée avec succès!";
        } else {
            echo "Erreur: " . $stmt->error;
        }

        // Fermer la déclaration
        $stmt->close();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une Pizza</title>
</head>
<body>
    <h2>Ajouter une Pizza</h2>
    <form method="post" action="">
        <label for="nom">Nom de la Pizza:</label>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="taille">Taille:</label>
        <textarea id="taille" name="taille" required></textarea><br><br>
        <label for="prix">Prix:</label>
        <input type="text" id="prix" name="prix" required><br><br>
        <input type="submit" value="Ajouter la Pizza">
    </form>
</body>
</html>
