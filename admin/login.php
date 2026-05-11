<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/auth.php';

if (is_admin_logged_in()) {
    redirect('index.php');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ? AND is_active = 1 LIMIT 1');
    $stmt->execute([trim($_POST['username'] ?? '')]);
    $admin = $stmt->fetch();
    if ($admin && password_verify((string) ($_POST['password'] ?? ''), $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        redirect('index.php');
    }
    $error = 'Invalid username or password.';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Sahyog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-shell text-center">
<!-- Login layout adapted from Bootstrap 5.3 Sign-in template. -->
<main class="form-signin w-100 m-auto">
    <form method="post" class="admin-card p-4 text-start">
        <h1 class="h3 mb-3 text-center">Admin Login</h1>
        <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
        <div class="form-floating mb-3">
            <input class="form-control" id="username" name="username" placeholder="Username" required autofocus>
            <label for="username">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <button class="btn btn-brand w-100 py-2" type="submit">Sign In</button>
        <div class="text-center mt-3">
            <a href="../index.php" class="text-decoration-none"><i class="bi bi-house-door"></i> Back to Home</a>
        </div>
        <p class="small text-muted mt-3 mb-0 text-center">Default: admin / admin123. Change this after setup.</p>
    </form>
</main>
</body>
</html>
