<?php
session_start();

// Récupérer les pizzas sélectionnées
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pizzas'])) {
    $_SESSION['panier'] = $_POST['pizzas'];
    header("Location: validation_commande.php");
    exit();
} else {
    echo "Aucune pizza sélectionnée.";
}
?>
