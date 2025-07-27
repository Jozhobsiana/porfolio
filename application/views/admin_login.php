<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if ($this->session->flashdata('error')): ?>
            <p class="error"><?= $this->session->flashdata('error') ?></p>
        <?php endif; ?>
        <form method="post" action="<?= base_url('admin/authenticate') ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>
