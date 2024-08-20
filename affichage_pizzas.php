<?php
// Inclure le fichier de configuration de la base de données
include 'db.php';

// Récupérer les pizzas disponibles
$sql = "SELECT * FROM pizzas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pizzas Disponibles</title>
</head>
<body>
    <h2>Pizzas Disponibles</h2>
    <form method="post" action="panier.php">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div>
                <h3><?php echo $row['nom']; ?></h3>
                <p>Taille: <?php echo $row['taille']; ?></p>
                <p>Prix: <?php echo $row['prix']; ?>€</p>
                <label for="quantite_<?php echo $row['id']; ?>">Quantité:</label>
                <input type="number" id="quantite_<?php echo $row['id']; ?>" name="pizzas[<?php echo $row['id']; ?>]" value="1" min="0">
            </div>
        <?php } ?>
        <input type="submit" value="Ajouter au Panier">
    </form>
</body>
</html>

<?php
$conn->close();
?>
