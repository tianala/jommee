<?php
include_once './connect_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idcategory = $_POST['idcategory'] ?? null;
    if ($idcategory) {
        try {
            $stmt = $pdo->prepare('DELETE FROM category WHERE idcategory = ?');
            $stmt->execute([$idcategory]);
            echo 'success';
        } catch (Exception $e) {
            echo 'error';   
        }
    } else {
        echo 'invalid';
    }
}
?>
