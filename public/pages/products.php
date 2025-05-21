<?php
require_once 'template/product_template.php';
require_once '../includes/product_functions.php';

// Handle all product operations and get the products
$products = handleProductOperations($pdo);

// Include navbar
// include '../../navbar.php';

// Render the product management page
renderProductManagement($products);
?>