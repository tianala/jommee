<?php
require_once '../includes/connect_db.php';
require_once '../includes/cart_functions.php';

// Start session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get current user ID (you'll need to replace this with your actual auth system)
$iduser = $_SESSION['user_id'] ?? 0; // Replace with your user authentication

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $idproduct = $_POST['idproduct'];
        $quantity = $_POST['quantity'] ?? 1;
        addToCart($pdo, $iduser, $idproduct, $quantity);
        header("Location: cart.php");
        exit();
    }
    
    if (isset($_POST['update_quantity'])) {
        $idcart = $_POST['idcart'];
        $quantity = $_POST['quantity'];
        updateCartQuantity($pdo, $idcart, $quantity);

        $quantity = max(1, (int)$quantity); // Ensure quantity is at least 1
        
        // Update in database
        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE idcart = ?");
        $stmt->execute([$quantity, $idcart]);
        
        // Redirect back to cart
        header("Location: cart.php");
        exit();
    }

    }
    
    if (isset($_POST['remove_item'])) {
        $idcart = $_POST['idcart'];
        removeFromCart($pdo, $idcart);
        header("Location: cart.php");
        exit();
    }

// Get cart items
$cartItems = getCartItems($pdo, $iduser);
$cartTotal = getCartTotal($pdo, $iduser);

// Include the view
require 'template/cart_template.php';
?>