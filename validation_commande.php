<?php
session_start();
include 'db.php';

// Récupérer les pizzas du panier
$pizzas = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];

if (empty($pizzas)) {
    echo "Votre panier est vide.";
    exit();
}

// Calculer le prix total
$total_price = 0;

foreach ($pizzas as $pizza_id => $quantity) {
    $sql = "SELECT * FROM pizzas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pizza_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pizza = $result->fetch_assoc();

    $total_price += $pizza['prix'] * $quantity;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Validation de la Commande</title>
</head>
<body>
    <h2>Validation de la Commande</h2>
    <p>Montant total : <?php echo $total_price; ?>€</p>
    <form method="post" action="confirmation_commande.php">
        <label for="pickup_type">Mode de retrait :</label>
        <select id="pickup_type" name="pickup_type" required>
            <option value="restaurant">Au restaurant</option>
            <option value="livraison">Livraison (2€ pour 3 pizzas ou plus, sinon 5€)</option>
        </select>
        <input type="submit" value="Confirmer la Commande">
    </form>
</body>
</html>

<?php
$conn->close();
?>
