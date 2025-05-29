<?php
session_start();
require_once '../includes/connect_db.php';

// if (!isset($_SESSION['iduser'])) {
//     header('Location: login.php');
//     exit;
// }

$iduser = $_SESSION['iduser'];
$stmt = $pdo->prepare("SELECT username, email, contact_num FROM user WHERE iduser = ?");
$stmt->execute([$iduser]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Settings | Jommee</title>
    <link href="/public/assets/css/output.css" rel="stylesheet">
    <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/lozad"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-pink-50 min-h-screen">
    <div class="w-full">
        <?php include_once '../includes/navbar.php' ?>
    </div>

    <?php if (!empty($_SESSION['profile_error'])): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-6 text-left">
            <?= $_SESSION['profile_error'];
            unset($_SESSION['profile_error']); ?></div>
    <?php elseif (!empty($_SESSION['profile_success'])): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6 text-left">
            <?= $_SESSION['profile_success'];
            unset($_SESSION['profile_success']); ?></div>
    <?php endif; ?>

    <main class="max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-10 p-6">
        <h1 class="text-3xl font-bold text-pink-600 mb-6 text-center">Profile Settings</h1>

        <form action="../includes/update_profile.php" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" required value="<?= htmlspecialchars($user['username']) ?>"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                <input type="text" name="contact_num" value="<?= htmlspecialchars($user['contact_num']) ?>"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-400 focus:outline-none">
            </div>

            <div class="border-t pt-6">
                <h2 class="text-xl font-semibold text-pink-600 mb-4">Change Password</h2>

                <label class="block mb-3">
                    <span class="text-gray-700 text-sm">Current Password</span>
                    <input type="password" name="current_password"
                        class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:ring-pink-400 focus:outline-none">
                </label>

                <label class="block mb-3">
                    <span class="text-gray-700 text-sm">New Password</span>
                    <input type="password" name="new_password" minlength="8"
                        class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:ring-pink-400 focus:outline-none"
                        placeholder="At least 8 characters, mixed case, number & symbol">
                </label>

                <label class="block mb-3">
                    <span class="text-gray-700 text-sm">Confirm New Password</span>
                    <input type="password" name="confirm_password" minlength="8"
                        class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:ring-pink-400 focus:outline-none">
                </label>
            </div>

            <button type="submit"
                class="bg-pink-600 text-white px-6 py-3 rounded hover:bg-pink-700 transition w-full font-semibold">
                Save Changes
            </button>
        </form>
    </main>

    <div class="w-full mt-10">
        <?php include_once '../includes/footer.php'; ?>
    </div>
</body>

</html>