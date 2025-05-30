<?php
require_once 'connect_db.php';

$search = $_POST['query'] ?? '';
$search = trim($search);

if ($search !== '') {
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
    $like = "%$search%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($product = $result->fetch_assoc()) {
        echo '<div class="bg-white p-4 rounded shadow">';
        echo '<img src="data:image/jpeg;base64,' . $product['image'] . '" class="w-full h-48 object-cover rounded">';
        echo '<h2 class="mt-2 font-semibold text-lg">' . htmlspecialchars($product['name']) . '</h2>';
        echo '<p class="text-[#fc8eac] font-bold">₱' . number_format($product['price'], 2) . '</p>';
        echo '<a href="view_product.php?id=' . $product['idproduct'] . '" class="text-sm text-blue-600 hover:underline">View</a>';
        echo '</div>';
    }
}
?>
