<?php
session_start();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../includes/connect_db.php';

    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!$email || !$username || !$contact || !$password || !$confirm_password) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address.';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $error = 'Password must be at least 8 characters and include uppercase, lowercase, number, and symbol.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Email is already registered.';
        } else {
            $password_hash = hash('sha256', $password);
            $stmt = $pdo->prepare("INSERT INTO user (email, username, contact_num, password, usertype) VALUES (?, ?, ?, ?, 1)");
            if ($stmt->execute([$email, $username, $contact, $password_hash])) {
                $success = 'Registration successful! You can now <a href="login.php" class="text-pink-600 hover:underline">log in</a>.';
            } else {
                $error = 'Something went wrong. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register | Jommee</title>
  <link href="./assets/css/output.css" rel="stylesheet" />
</head>
<body class="bg-pink-50 min-h-screen flex flex-col">

  <main class="flex-grow flex items-center justify-center px-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg mt-10 p-8 md:p-12 text-center">
      <h1 class="text-4xl font-bold text-pink-600 mb-6">Create an Account</h1>

      <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-6 text-left"><?= htmlspecialchars($error) ?></div>
      <?php elseif ($success): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6 text-left"><?= $success ?></div>
      <?php endif; ?>

      <form method="POST" action="register.php" class="space-y-5 text-left">

        <label class="block">
          <span class="font-semibold text-gray-700">Email</span>
          <input type="email" name="email" required placeholder="you@example.com"
            class="w-full border border-gray-300 rounded px-4 py-3 focus:ring-pink-400 focus:outline-none" />
        </label>

        <label class="block">
          <span class="font-semibold text-gray-700">Username</span>
          <input type="text" name="username" required placeholder="Your name"
            class="w-full border border-gray-300 rounded px-4 py-3 focus:ring-pink-400 focus:outline-none" />
        </label>

        <label class="block">
          <span class="font-semibold text-gray-700">Contact Number</span>
          <input type="text" name="contact" required placeholder="09XXXXXXXXX"
            class="w-full border border-gray-300 rounded px-4 py-3 focus:ring-pink-400 focus:outline-none" />
        </label>

        <label class="block">
          <span class="font-semibold text-gray-700">Password</span>
          <input type="password" name="password" required placeholder="Create a strong password"
            class="w-full border border-gray-300 rounded px-4 py-3 focus:ring-pink-400 focus:outline-none" />
          <small class="text-gray-500 block mt-1">Min 8 chars, must include A-Z, a-z, 0-9, symbol.</small>
        </label>

        <label class="block">
          <span class="font-semibold text-gray-700">Confirm Password</span>
          <input type="password" name="confirm_password" required placeholder="Repeat password"
            class="w-full border border-gray-300 rounded px-4 py-3 focus:ring-pink-400 focus:outline-none" />
        </label>

        <button type="submit"
          class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded shadow transition">
          Register
        </button>
      </form>

      <p class="mt-6 text-gray-600">
        Already have an account?
        <a href="login.php" class="text-pink-600 font-semibold hover:underline">Log in here</a>
      </p>
    </div>
  </main>

  <div class="w-full">
    <?php include_once '../includes/footer.php'; ?>
  </div>

</body>
</html>
