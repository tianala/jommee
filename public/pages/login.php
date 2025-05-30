<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../includes/connect_db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_hash = hash('sha256', $password);

    if (!$email || !$password) {
        $error = 'Please fill in both fields.';
    } else {
        $stmt = $pdo->prepare("SELECT iduser, email, usertype, password FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && ($password_hash == $user['password'])) {
            $_SESSION['iduser'] = $user['iduser'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['usertype'] = $user['usertype'];
            $_SESSION['logged_in'] = true;
            header('Location: products.php');
            exit();
        } else {
            $error = 'Invalid email or password.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Jommee</title>
    <link href="./assets/css/output.css" rel="stylesheet" />
</head>

<body class="bg-pink-50 min-h-screen flex flex-col">
    <main class="flex-grow flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 md:p-12 text-center mt-10">
            <h1 class="text-4xl font-bold text-pink-600 mb-6">Login to Jommee</h1>

            <?php if ($error): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded mb-6 text-left"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="login.php" class="space-y-6 text-left">
                <label class="block">
                    <span class="font-semibold text-gray-700 mb-1 block">Email</span>
                    <input type="email" name="email" required placeholder="you@example.com"
                        class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400" />
                </label>

                <label class="block">
                    <span class="font-semibold text-gray-700 mb-1 block">Password</span>
                    <input type="password" name="password" required placeholder="Your password"
                        class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400" />
                </label>

                <button type="submit"
                    class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded shadow transition">
                    Log In
                </button>
            </form>

            <p class="mt-6 text-gray-600">
                Don’t have an account?
                <a href="register.php" class="text-pink-600 font-semibold hover:underline">Register here</a>
            </p>
        </div>
    </main>

    <!-- Footer placeholder -->
    <div class="w-full">
        <?php include_once '../includes/footer.php'; ?>
    </div>
</body>

</html>