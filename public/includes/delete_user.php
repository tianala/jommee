<?php
include_once './connect_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['iduser'];

    $stmt = $pdo->prepare("DELETE FROM users WHERE iduser = ?");
    if ($stmt->execute([$id])) {
        echo 'success';
    } else {
        echo 'error';
    }
}
