<?php
require_once 'connect_db.php';

function handleProductOperations($pdo) {
    // Add Product
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $main_img = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $main_img = file_get_contents($_FILES['image']['tmp_name']);
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
        $main_img = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $main_img = file_get_contents($_FILES['image']['tmp_name']);
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

    // Get all products
    $sql = "SELECT * FROM product";
    return $pdo->query($sql);
}

function getProductImage($row) {
    if (!empty($row['main_img'])) {
        return 'data:image/jpeg;base64,'.base64_encode($row['main_img']);
    }
    return null;
}
?>