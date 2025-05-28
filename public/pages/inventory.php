<?php
require_once '../includes/product_functions.php';
$stmt1 = $pdo->prepare("SELECT idproduct, stock, name FROM product ORDER BY stock DESC");
$stmt1->execute();
$products = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Management</title>
    <link href="/public/assets/css/output.css" rel="stylesheet">
    <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/lozad"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-gray-50 text-gray-800">
    <div>
        <?php include_once '../includes/navbar.php' ?>
    </div>

    <main class="max-w-7xl mx-auto p-6 space-y-10">
        <div class="w-full mb-3 mx-auto">
            <h1 class="text-5xl font-semibold">Inventory</h1>
        </div>

        <div class="w-full bg-gray-100 rounded-lg p-4">

            <?php
            $inStock = [];
            $lowStock = [];
            $outOfStock = [];

            foreach ($products as $product) {
                if ($product['stock'] >= 15) {
                    $inStock[] = $product;
                } elseif ($product['stock'] > 0) {
                    $lowStock[] = $product;
                } else {
                    $outOfStock[] = $product;
                }
            }

            function renderProductSection($title, $products, $color, $icon)
            {
                $count = count($products);
                echo "<div class='mb-10'>";
                echo "<div class='flex items-center gap-4 mb-4'>
            <h2 class='text-2xl font-bold text-{$color}-600'>{$title}</h2>
            <span class='text-sm font-medium text-pink-500'>{$count} item" . ($count !== 1 ? 's' : '') . "</span>
          </div>";

                if ($count > 0) {
                    echo "<div class='grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4'>";
                    foreach ($products as $product) {
                        echo "
            <div class='bg-white border-l-4 border-{$color}-500 shadow hover:shadow-lg rounded-lg p-4 transition cursor-pointer'>
                <div class='text-xl font-semibold text-gray-800 mb-1'>{$product['name']}</div>
                <div class='text-sm text-gray-600'>Stock: <span class='font-bold'>{$product['stock']}</span></div>
                <div class='text-sm text-gray-500'>
                    <a href='edit_product.php?id={$product['idproduct']}' class='text-blue-600 hover:underline'>Tap to view details</a>
                </div>
            </div>
            ";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='text-gray-500 italic'>No products in this category.</div>";
                }
                echo "</div>";
            }


            renderProductSection('In Stock', $inStock, 'green', 'fa-check-circle');
            renderProductSection('Low Stock', $lowStock, 'yellow', 'fa-exclamation-circle');
            renderProductSection('Out of Stock', $outOfStock, 'red', 'fa-times-circle');
            ?>
        </div>

    </main>

    <div>
        <?php include_once '../includes/footer.php' ?>
    </div>
</body>


</html>

<script>

</script>