<?php
require_once 'connect_db.php';

function getProductData($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE idproduct = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function validateProductInput($input) {
    $errors = [];
    
    if (empty(trim($input['name']))) {
        $errors['name'] = 'Product name is required';
    }
    if (floatval($input['price']) <= 0) {
        $errors['price'] = 'Price must be greater than 0';
    }
    if (intval($input['stock']) < 0) {
        $errors['stock'] = 'Stock cannot be negative';
    }
    
    return $errors;
}

function handleImageUploads($files) {
    $imageUpdates = [];
    $errors = [];
    $imageFields = ['main_img', 'img1', 'img2', 'img3', 'img4'];
    
    foreach ($imageFields as $field) {
        if (!empty($files[$field]['name'])) {
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($fileInfo, $files[$field]['tmp_name']);
            finfo_close($fileInfo);
            
            if (strpos($mimeType, 'image/') === 0) {
                $imageUpdates[$field] = file_get_contents($files[$field]['tmp_name']);
            } else {
                $errors[$field] = 'Invalid image file';
            }
        }
    }
    
    return ['updates' => $imageUpdates, 'errors' => $errors];
}

function updateProduct($pdo, $id, $data, $imageUpdates) {
    try {
        $pdo->beginTransaction();
        
        $query = "UPDATE product SET name = :name, price = :price, stock = :stock, description = :description";
        $params = [
            ':name' => trim($data['name']),
            ':price' => floatval($data['price']),
            ':stock' => intval($data['stock']),
            ':description' => trim($data['description']),
            ':id' => $id
        ];
        
        foreach ($imageUpdates as $field => $value) {
            $query .= ", $field = :$field";
            $params[":$field"] = $value;
        }
        
        $query .= " WHERE idproduct = :id";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        
        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}

function prepareProductImages($product) {
    $all_images = [];
    $all_images[] = base64_encode($product['main_img']);
    
    for ($i = 1; $i <= 4; $i++) {
        $img_key = 'img'.$i;
        if (!empty($product[$img_key])) {
            $all_images[] = base64_encode($product[$img_key]);
        }
    }
    
    return $all_images;
}
?>