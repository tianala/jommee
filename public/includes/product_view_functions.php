<?php
function getProductById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE idproduct = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function prepareProductImages($product) {
    $all_images = [];
    if (!empty($product['main_img'])) {
        $all_images[] = base64_encode($product['main_img']);
    }
    
    for ($i = 1; $i <= 4; $i++) {
        $img_key = 'img'.$i;
        if (!empty($product[$img_key])) {
            $all_images[] = base64_encode($product[$img_key]);
        }
    }
    
    return $all_images;
}

function deleteProduct($pdo, $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM product WHERE idproduct = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        error_log("Error deleting product: " . $e->getMessage());
        return false;
    }
}
?>