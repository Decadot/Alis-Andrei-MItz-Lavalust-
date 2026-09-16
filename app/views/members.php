<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Member CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        form { max-width: 500px; }
        input { width: 100%; padding: 10px; margin: 6px 0; box-sizing: border-box; }
        button { padding: 10px 15px; margin-right: 8px; }
        .error { color: red; margin-bottom: 12px; }
        .success { color: green; margin-bottom: 12px; }
    </style>
</head>
<body>
    <h2>Add Member</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('members/store') ?>">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Save</button>
    </form>

    <h2>Members</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($members)): ?>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?= htmlspecialchars($member['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($member['name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($member['username'] ?? '') ?></td>
                        <td>********</td>
                        <td>
                            <a href="<?= site_url('members/edit/' . ($member['id'] ?? 0)) ?>">Edit</a>
                            |
                            <a href="<?= site_url('members/delete/' . ($member['id'] ?? 0)) ?>" onclick="return confirm('Delete this member?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No members found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
