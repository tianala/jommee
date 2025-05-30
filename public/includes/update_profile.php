<?php
session_start();
require_once '../includes/connect_db.php';

if (!isset($_SESSION['iduser'])) {
    header('Location: login.php');
    exit;
}

$iduser = $_SESSION['iduser'];
$error = '';
$success = '';

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$contact_num = trim($_POST['contact_num'] ?? '');

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
} else {
    // Update profile info
    $stmt = $pdo->prepare("UPDATE user SET username = ?, email = ?, contact_num = ? WHERE iduser = ?");
    $stmt->execute([$username, $email, $contact_num, $iduser]);
    $success = "Profile updated successfully.";
}

// Handle password change
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if ($current_password && $new_password && $confirm_password) {
    // Password validation
    if (strlen($new_password) < 8 ||
        !preg_match('/[A-Z]/', $new_password) ||
        !preg_match('/[a-z]/', $new_password) ||
        !preg_match('/[0-9]/', $new_password) ||
        !preg_match('/[^a-zA-Z0-9]/', $new_password)) {
        $error = "New password must be at least 8 characters long and include uppercase, lowercase, number, and symbol.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } else {
        // Check current password
        $stmt = $pdo->prepare("SELECT password FROM user WHERE iduser = ?");
        $stmt->execute([$iduser]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $current_hashed = hash('sha256', $current_password);

        if ($current_hashed !== $user['password']) {
            $error = "Current password is incorrect.";
        } else {
            // Update password
            $new_hashed = hash('sha256', $new_password);
            $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE iduser = ?");
            $stmt->execute([$new_hashed, $iduser]);
            $success .= " Password updated successfully.";
        }
    }
}

if ($error) {
    $_SESSION['profile_error'] = $error;
} else {
    $_SESSION['profile_success'] = $success;
}

header('Location: ../pages/profile.php');
exit;
