<?php
function getProductById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE idproduct = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function prepareProductImages($product) {
    $all_images = [];
    $all_images[] = base64_encode($product['main_img']); // Main image first
    
    for ($i = 1; $i <= 4; $i++) {
        $img_key = 'img'.$i;
        if (!empty($product[$img_key])) {
            $all_images[] = base64_encode($product[$img_key]);
        }
    }
    
    return $all_images;
}
?>