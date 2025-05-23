<?php
require_once '../includes/connect_db.php';
require_once '../includes/edit_product_functions.php';
require_once 'template/edit_product_template.php';

// Check if product ID is provided
if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];
$errors = [];
$success = false;

// Fetch product data
$product = getProductData($pdo, $id);

if (!$product) {
    echo "Product not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    $errors = validateProductInput($_POST);
    
    // Handle image uploads
    $imageResult = handleImageUploads($_FILES);
    $imageUpdates = $imageResult['updates'];
    $errors = array_merge($errors, $imageResult['errors']);
    
    // Update database if no errors
    if (empty($errors)) {
        try {
            $success = updateProduct($pdo, $id, $_POST, $imageUpdates);
            
            // Refresh product data
            $product = getProductData($pdo, $id);
        } catch (PDOException $e) {
            $errors['database'] = 'Error updating product: ' . $e->getMessage();
        }
    }
}

// Prepare images for display
$all_images = prepareProductImages($product);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?= htmlspecialchars($product['name']) ?> - Product Management</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome.min.css">
    <style>
        .carousel-container {
            scroll-snap-type: x mandatory;
        }
        .carousel-slide {
            scroll-snap-align: start;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 50;
            min-width: 160px;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .dropdown-menu.show {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-50">
          <div class="w-full">
        <?php require_once '../includes/navbar.php' ?>
    </div>
    <div class="max-w-7xl mx-auto p-4 md:p-8">
        <?php displayBreadcrumbs($product['name']); ?>

        <?php if ($success): ?>
            <?php displaySuccessMessage($id); ?>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="relative grid md:grid-cols-2 gap-8 bg-white p-6 rounded-lg shadow-md">
            <a href="product_view.php" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>

            <?php displayImageCarousel($all_images, $product['name'], $errors); ?>
            <?php displayProductForm($product, $errors); ?>
        </form>
    </div>

    <?php displayCarouselScript(); ?>
</body>
</html>
<?php include '../includes/footer.php'; ?>