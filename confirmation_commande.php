<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // ID de l'utilisateur connecté
    $pizzas = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];
    $pickup_type = $_POST['pickup_type'];

    // Calculer le prix total avec les frais de livraison
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

    if ($pickup_type == "livraison") {
        $total_price += (count($pizzas) >= 3) ? 2 : 5;
    }

    // Insérer la commande dans la table orders
    $sql = "INSERT INTO orders (user_id, pickup_type, total_price, order_date) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isd", $user_id, $pickup_type, $total_price);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Insérer chaque pizza dans la table order_items
        foreach ($pizzas as $pizza_id => $quantity) {
            $sql = "INSERT INTO order_items (order_id, pizza_id, quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $order_id, $pizza_id, $quantity);
            $stmt->execute();
        }

        echo "Commande confirmée!";
        unset($_SESSION['panier']); // Vider le panier après confirmation
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
