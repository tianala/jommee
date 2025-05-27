<?php
require_once 'connect_db.php';

function compressImage($blob, $quality = 75) {
    $tmpPath = tempnam(sys_get_temp_dir(), 'img_');
    file_put_contents($tmpPath, $blob);

    $info = getimagesize($tmpPath);

    if ($info === false) {
        unlink($tmpPath);
        throw new Exception("Failed to read image info. Possibly corrupt or invalid format.");
    }

    switch ($info['mime']) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($tmpPath);
            break;
        case 'image/png':
            $image = imagecreatefrompng($tmpPath);
            $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
            imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
            imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
            $image = $bg;
            break;
        case 'image/webp':
            $image = imagecreatefromwebp($tmpPath);
            break;
        default:
            unlink($tmpPath);
            throw new Exception("Unsupported image format.");
    }

    ob_start();
    imagejpeg($image, null, $quality);
    $compressed = ob_get_clean();
    imagedestroy($image);
    unlink($tmpPath);

    return $compressed;
}

function compressAllProductImages($pdo) {
    try {
        $stmt = $pdo->query("SELECT idproduct, main_img FROM product WHERE main_img IS NOT NULL");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $updateStmt = $pdo->prepare("UPDATE product SET main_img = ? WHERE idproduct = ?");

        foreach ($products as $product) {
            try {
                $compressed = compressImage($product['main_img'], 75);
                $updateStmt->execute([$compressed, $product['idproduct']]);
            } catch (Exception $e) {
                echo "Skipping product ID {$product['idproduct']}: " . htmlspecialchars($e->getMessage()) . "<br>";
            }
        }

        echo "All product images processed.";
    } catch (Exception $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
}

function handleProductOperations($pdo) {
    // Add Product
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $main_img = null;

        if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
            $main_img = compressImage(file_get_contents($_FILES['image']['tmp_name']), 75);
        }

        $sql = "INSERT INTO product (name, price, main_img) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $price, $main_img]);
        
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Update Product
    if (isset($_POST['update_product'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
            $main_img = compressImage(file_get_contents($_FILES['image']['tmp_name']), 75);
            $sql = "UPDATE product SET name = ?, price = ?, main_img = ? WHERE idproduct = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $price, $main_img, $id]);
        } else {
            $sql = "UPDATE product SET name = ?, price = ? WHERE idproduct = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $price, $id]);
        }
        
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Delete Product
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM product WHERE idproduct = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    if (isset($_POST['compress'])) {

    }

    // Get all products
    $sql = "SELECT idcategory, idproduct, name, price, stock, description, main_img FROM product";
    return $pdo->query($sql);
}

function getProductImage($row) {
    if (!empty($row['main_img'])) {
        return 'data:image/jpeg;base64,'.base64_encode($row['main_img']);
    }
    return null;
}
?>