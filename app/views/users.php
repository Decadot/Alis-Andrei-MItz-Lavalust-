<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 960px; margin: 32px auto; padding: 0 16px; }
        form { display: grid; gap: 10px; max-width: 480px; }
        input, button { padding: 10px; font: inherit; }
        table { border-collapse: collapse; width: 100%; margin-top: 28px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        .error { color: #b00020; margin: 12px 0; }
    </style>
</head>
<body>

    <h1>User CRUD</h1>
    <p>Records are stored in the separate <code>user_crud</code> database.</p>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('users/store') ?>">
        <input type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($old['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($old['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Create User</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($user['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($user['username'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td>********</td>
                    <td><a href="<?= site_url('users/edit/' . ($user['id'] ?? 0)) ?>">Edit</a> | <a href="<?= site_url('users/delete/' . ($user['id'] ?? 0)) ?>" onclick="return confirm('Delete this user?')">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
