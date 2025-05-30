<?php
include_once './connect_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? null;

    if ($name) {
        try {
            $stmt = $pdo->prepare('INSERT INTO category (name) VALUES (?)');
            $stmt->execute([$name]);
            echo 'success';
        } catch (Exception $e) {
            echo 'error';
        }
    } else {
        echo 'invalid';
    }
}
?>
