<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>
<body>
<div class="login-container">
    <h2>Create Admin Account</h2>

    <?php if ($this->session->flashdata('error')): ?>
        <p class="error"><?= $this->session->flashdata('error') ?></p>
    <?php elseif ($this->session->flashdata('success')): ?>
        <p class="success"><?= $this->session->flashdata('success') ?></p>
    <?php endif; ?>

    <form method="post" action="<?= base_url('admin/create_account') ?>">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <p style="text-align:center;margin-top:10px;"><a href="<?= base_url('admin/login') ?>">Back to Login</a></p>
</div>
</body>
</html>
