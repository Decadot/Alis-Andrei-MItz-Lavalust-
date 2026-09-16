<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 640px; margin: 32px auto; padding: 0 16px; }
        form { display: grid; gap: 10px; }
        input, textarea, button { padding: 10px; font: inherit; }
        textarea { min-height: 120px; resize: vertical; }
        .error { color: #b00020; margin: 12px 0; }
        .actions { display: flex; gap: 8px; align-items: center; }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form method="post" action="<?= htmlspecialchars($formAction, ENT_QUOTES, 'UTF-8') ?>">
        <label>Product name
            <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" maxlength="100" required>
        </label>
        <label>Description
            <textarea name="description"><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </label>
        <label>Price
            <input type="number" name="price" value="<?= htmlspecialchars($product['price'] ?? '', ENT_QUOTES, 'UTF-8') ?>" min="0" step="0.01" required>
        </label>
        <label>Quantity
            <input type="number" name="quantity" value="<?= htmlspecialchars($product['quantity'] ?? '', ENT_QUOTES, 'UTF-8') ?>" min="0" step="1" required>
        </label>
        <div class="actions">
            <button type="submit">Save Product</button>
            <a href="<?= site_url('products') ?>">Cancel</a>
        </div>
    </form>
</body>
</html>
