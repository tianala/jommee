<?php
include_once './connect_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idcategory = $_POST['idcategory'] ?? null;
    $name = $_POST['name'] ?? null;

    if ($idcategory && $name) {
        try {
            $stmt = $pdo->prepare('UPDATE category SET name = ? WHERE idcategory = ?');
            $stmt->execute([$name, $idcategory]);
            echo 'success';
        } catch (Exception $e) {
            echo 'error';
        }
    } else {
        echo 'invalid';
    }
}
?>
