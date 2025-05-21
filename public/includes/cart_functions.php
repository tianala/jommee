<?php
require_once 'connect_db.php';

function addToCart($pdo, $iduser, $idproduct, $quantity = 1) {
    // Check if product already exists in cart
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE iduser = ? AND idproduct = ?");
    $stmt->execute([$iduser, $idproduct]);
    $existing = $stmt->fetch();

    if ($existing) {
        // Update quantity if product exists
        $newQuantity = $existing['quantity'] + $quantity;
        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE idcart = ?");
        return $stmt->execute([$newQuantity, $existing['idcart']]);
    } else {
        // Add new item to cart
        $stmt = $pdo->prepare("INSERT INTO cart (iduser, idproduct, quantity) VALUES (?, ?, ?)");
        return $stmt->execute([$iduser, $idproduct, $quantity]);
    }
}

function getCartItems($pdo, $iduser) {
    $stmt = $pdo->prepare("
        SELECT c.*, p.name, p.price, p.main_img 
        FROM cart c
        JOIN product p ON c.idproduct = p.idproduct
        WHERE c.iduser = ?
    ");
    $stmt->execute([$iduser]);
    return $stmt->fetchAll();
}

function removeFromCart($pdo, $idcart) {
    $stmt = $pdo->prepare("DELETE FROM cart WHERE idcart = ?");
    return $stmt->execute([$idcart]);
}

function updateCartQuantity($pdo, $idcart, $quantity) {
    try {
        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE idcart = ?");
        $stmt->execute([$quantity, $idcart]);
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        // Handle error
        error_log("Error updating cart quantity: " . $e->getMessage());
        return false;
    }
}

function getCartTotal($pdo, $iduser) {
    $stmt = $pdo->prepare("
        SELECT SUM(p.price * c.quantity) as total
        FROM cart c
        JOIN product p ON c.idproduct = p.idproduct
        WHERE c.iduser = ?
    ");
    $stmt->execute([$iduser]);
    $result = $stmt->fetch();
    return $result['total'] ?? 0;
}
?>