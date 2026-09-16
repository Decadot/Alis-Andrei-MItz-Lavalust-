<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>
    <p>You are logged in.</p>
    <p><a href="<?= site_url('products') ?>">Product Management</a></p>
    <a href="<?= site_url('logout') ?>">Logout</a>
</body>
</html>
