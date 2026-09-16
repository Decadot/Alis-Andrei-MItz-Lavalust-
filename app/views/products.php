<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1100px; margin: 32px auto; padding: 0 16px; }
        table { border-collapse: collapse; width: 100%; margin-top: 24px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f3f3f3; }
        .error { color: #b00020; margin: 12px 0; }
        .actions { display: flex; gap: 8px; align-items: center; }
        .actions form { display: inline; }
        a, button { padding: 6px 10px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Product Management</h1>
    <p><a href="<?= site_url('products/create') ?>">Add Product</a> | <a href="<?= site_url('logout') ?>">Logout</a></p>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($product['product_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars(number_format((float) ($product['price'] ?? 0), 2), ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($product['quantity'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($product['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="actions">
                            <a href="<?= site_url('products/edit/' . ($product['id'] ?? 0)) ?>">Edit</a>
                            <form method="post" action="<?= site_url('products/delete/' . ($product['id'] ?? 0)) ?>" onsubmit="return confirm('Delete this product?')">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No products found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
