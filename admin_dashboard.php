<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT o.id, o.order_date, u.nom AS client_nom, o.total_price, o.pickup_type 
        FROM orders o
        JOIN users u ON o.user_id = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord Administrateur</title>
</head>
<body>
    <h2>Commandes Passées</h2>
    <table border="1">
        <tr>
            <th>ID Commande</th>
            <th>Date de Commande</th>
            <th>Client</th>
            <th>Prix Total</th>
            <th>Mode de Retrait</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['order_date']; ?></td>
                <td><?php echo $row['client_nom']; ?></td>
                <td><?php echo $row['total_price']; ?>€</td>
                <td><?php echo $row['pickup_type']; ?></td>
            </
