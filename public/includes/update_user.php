<?php
include_once './connect_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['iduser'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact_num'];
    $usertype = $_POST['usertype'];

    $stmt = $pdo->prepare("UPDATE user SET username = ?, email = ?, contact_num = ?, usertype=? WHERE iduser = ?");
    if ($stmt->execute([$username, $email, $contact, $usertype, $id])) {
        echo 'success';
    } else {
        echo 'error';
    }
}
