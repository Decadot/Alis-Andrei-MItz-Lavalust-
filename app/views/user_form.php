<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Edit User</title></head>
<body>
    <h1>Edit User</h1>
    <?php if (!empty($error)): ?><p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
    <form method="post" action="<?= site_url('users/update/' . ($user['id'] ?? 0)) ?>">
        <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <input type="password" name="password" placeholder="New password (optional)">
        <input type="password" name="confirm_password" placeholder="Confirm new password">
        <button type="submit">Update User</button>
    </form>
    <p><a href="<?= site_url('users') ?>">Cancel</a></p>
</body>
</html>
