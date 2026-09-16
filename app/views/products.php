<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Northstar Supply</title>
    <style>
        :root { --navy: #071b2d; --pine: #123f36; --teal: #18b7a0; --mint: #d9f4eb; --ink: #102d3d; --muted: #6a8582; --line: #c9e4dc; --paper: #f4fbf8; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; color: var(--ink); font-family: "Trebuchet MS", sans-serif; background: radial-gradient(circle at 88% 0, #d9f4eb 0, transparent 25%), var(--paper); }
        header, main { max-width: 1240px; margin: auto; padding-left: 24px; padding-right: 24px; }
        header { display: flex; align-items: center; justify-content: space-between; padding-top: 28px; padding-bottom: 28px; }
        .brand { color: var(--navy); font-family: Georgia, serif; font-size: 20px; font-weight: bold; }
        nav { display: flex; gap: 18px; align-items: center; } nav a { color: var(--pine); font-size: 14px; font-weight: bold; text-decoration: none; }
        main { padding-top: 45px; padding-bottom: 70px; }
        .eyebrow { color: #087f78; font-size: 12px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; }
        h1 { margin: 12px 0 8px; color: var(--navy); font-family: Georgia, serif; font-size: clamp(38px, 5vw, 62px); }
        .intro { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 32px; }
        .intro p { margin: 0; color: var(--muted); }
        .primary { display: inline-block; padding: 13px 17px; border-radius: 8px; color: white; background: var(--pine); font-weight: bold; text-decoration: none; white-space: nowrap; }
        .primary:hover { background: #0d5b4b; }
        .table-wrap { overflow-x: auto; border: 1px solid var(--line); border-radius: 12px; background: white; box-shadow: 0 14px 36px rgba(7, 27, 45, .08); }
        table { width: 100%; min-width: 860px; border-collapse: collapse; }
        th, td { padding: 16px; border-bottom: 1px solid #e2eee9; text-align: left; }
        th { color: #54736f; background: #edf8f3; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; }
        tr:last-child td { border-bottom: 0; } td { font-size: 14px; } td:first-child { color: var(--muted); }
        .product-name { color: var(--navy); font-weight: bold; } .description { max-width: 250px; color: var(--muted); }
        .actions { display: flex; gap: 10px; align-items: center; white-space: nowrap; } .actions form { display: inline; }
        .edit, .delete { padding: 7px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; cursor: pointer; text-decoration: none; }
        .edit { color: #087f78; background: var(--mint); } .delete { border: 0; color: #8e2d2d; background: #fde9e4; font: inherit; }
        .error { padding: 12px 14px; border-radius: 8px; color: #8e2d2d; background: #fde9e4; }
        .empty { padding: 40px; color: var(--muted); text-align: center; }
        @media (max-width: 680px) { header, main { padding-left: 18px; padding-right: 18px; } .intro { display: block; } .primary { margin-top: 20px; } nav { gap: 10px; } }
    </style>
</head>
<body>
    <header><div class="brand">NORTHSTAR / SUPPLY</div><nav><a href="<?= site_url('dashboard') ?>">Dashboard</a><a href="<?= site_url('logout') ?>">Log out</a></nav></header>
    <main>
        <div class="eyebrow">Inventory workspace</div>
        <div class="intro"><div><h1>Products</h1><p>Track what is in stock and keep your catalog current.</p></div><a class="primary" href="<?= site_url('products/create') ?>">+ Add product</a></div>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

        <div class="table-wrap"><table>
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
                        <td class="product-name"><?= htmlspecialchars($product['product_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="description"><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars(number_format((float) ($product['price'] ?? 0), 2), ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($product['quantity'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($product['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="actions">
                            <a class="edit" href="<?= site_url('products/edit/' . ($product['id'] ?? 0)) ?>">Edit</a>
                            <form method="post" action="<?= site_url('products/delete/' . ($product['id'] ?? 0)) ?>" onsubmit="return confirm('Delete this product?')">
                                <button class="delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td class="empty" colspan="7">No products found yet. Add your first product to get started.</td></tr>
            <?php endif; ?>
        </tbody>
        </table></div>
    </main>
</body>
</html>
