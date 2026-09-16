<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Member</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        form { max-width: 500px; }
        input { width: 100%; padding: 10px; margin: 6px 0; box-sizing: border-box; }
        button { padding: 10px 15px; margin-right: 8px; }
        .error { color: red; margin-bottom: 12px; }
    </style>
</head>
<body>
    <h2>Edit Member</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('members/update/' . ($member['id'] ?? 0)) ?>">
        <input type="text" name="name" value="<?= htmlspecialchars($member['name'] ?? '') ?>" required>
        <input type="text" name="username" value="<?= htmlspecialchars($member['username'] ?? '') ?>" required>
        <input type="password" name="password" placeholder="New Password (optional)">
        <input type="password" name="confirm_password" placeholder="Confirm New Password">
        <button type="submit">Update</button>
        <a href="<?= site_url('members') ?>">Cancel</a>
    </form>
</body>
</html>
