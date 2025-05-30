<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'connect_db.php';

if (!isset($_SESSION['iduser'])) {
    header('Location: ../index.php');
    exit();
}

$iduser = $_SESSION['iduser'];
$ref_num = strtoupper(uniqid("REF"));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['idproduct']) && !empty($_POST['quantity'])) {
    $idproduct = $_POST['idproduct'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("SELECT price, name FROM product WHERE idproduct = ?");
    $stmt->execute([$idproduct]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $price = $product['price'];
        $name = $product['name'];

        $insert = $pdo->prepare("INSERT INTO `order` (iduser, idproduct, quantity, price, created_at, name, ref_num)
                                 VALUES (?, ?, ?, ?, NOW(), ?, ?)");
        $success = $insert->execute([$iduser, $idproduct, $quantity, $price, $name, $ref_num]);

        if ($success) {
            // Deduct quantity from product
            $update = $pdo->prepare("UPDATE product SET stock = stock - ? WHERE idproduct = ?");
            $update->execute([$quantity, $idproduct]);

            header("Location: ../pages/thank_you.php?ref=$ref_num");
            exit();
        } else {
            die("Failed to create order.");
        }
    } else {
        die("Product not found.");
    }
} else {
    echo "Quantity: " . $_POST['quantity'];
    echo "ID: " . $_POST['idproduct'];
    die("Invalid request. Missing product ID or quantity.");
}
