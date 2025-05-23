<?php
require_once '../includes/connect_db.php';
require_once '../includes/product_view_functions.php';
session_start(); // Make sure session is started

// Check if product ID is provided
if (!isset($_GET['id'])) {
    $_SESSION['error'] = "Product ID not provided.";
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];
$product = getProductById($pdo, $id);

if (!$product) {
    $_SESSION['error'] = "Product not found.";
    header("Location: products.php");
    exit();
}

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    if (deleteProduct($pdo, $id)) {
        $_SESSION['success'] = "Product deleted successfully.";
        header("Location: products.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to delete product.";
        header("Location: product_view.php?id=".$id);
        exit();
    }
}

// Prepare all images (main + additional)
$all_images = prepareProductImages($product);

// Display the template
require 'template/product_view_template.php';
?>