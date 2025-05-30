<?php
require_once '../includes/connect_db.php';
session_start();

if (!isset($_SESSION['iduser'])) {
    header('Location: login.php');
    exit();
}

$iduser = $_SESSION['iduser'];
$selectedItems = json_decode($_POST['selected_items'], true);

$ref_num = strtoupper(uniqid("REF"));

$now = date('Y-m-d H:i:s');

foreach ($selectedItems as $item) {
    $stmt = $pdo->prepare("SELECT p.name, p.price, c.idproduct 
                           FROM cart c 
                           JOIN product p ON c.idproduct = p.idproduct 
                           WHERE c.idcart = ? AND c.iduser = ?");
    $stmt->execute([$item['idcart'], $iduser]);
    $data = $stmt->fetch();

    if ($data) {
        $stmt = $pdo->prepare("INSERT INTO `order` (iduser, idproduct, name, quantity, price, ref_num, created_at)
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $iduser,
            $data['idproduct'],
            $data['name'],
            $item['quantity'],
            $data['price'],
            $ref_num,
            $now
        ]);

        // Remove item from cart
        $stmt = $pdo->prepare("DELETE FROM cart WHERE idcart = ? AND iduser = ?");
        $stmt->execute([$item['idcart'], $iduser]);
    }
}

header("Location: ../pages/thank_you.php?ref=$ref_num");
exit();
