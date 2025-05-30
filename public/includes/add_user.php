<?php
include_once './connect_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];
    $contact = $_POST['contact_num'];

    $hashedPassword = hash('sha256', $email);

    $stmt = $pdo->prepare("INSERT INTO user (username, email, password, contact_num, usertype) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$username, $email, $hashedPassword, $contact, $usertype])) {
        echo 'success';
    } else {
        echo 'error';
    }
}
