<?php
require_once '../includes/connect_db.php';
require_once '../includes/product_view_functions.php';

// Check if product ID is provided
if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];
$product = getProductById($pdo, $id);

if (!$product) {
    echo "Product not found.";
    exit();
}

// Prepare all images (main + additional)
$all_images = prepareProductImages($product);

// Display the template
require 'template/product_view_template.php';
?>