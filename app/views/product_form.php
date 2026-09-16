<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?> | Northstar Supply</title>
    <style>
        :root { --navy: #071b2d; --pine: #123f36; --teal: #18b7a0; --mint: #d9f4eb; --ink: #102d3d; --muted: #6a8582; --line: #c9e4dc; --paper: #f4fbf8; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; color: var(--ink); font-family: "Trebuchet MS", sans-serif; background: radial-gradient(circle at 90% 0, #d9f4eb 0, transparent 28%), var(--paper); }
        header { display: flex; align-items: center; justify-content: space-between; max-width: 900px; margin: auto; padding: 28px 24px; }
        .brand { color: var(--navy); font-family: Georgia, serif; font-size: 20px; font-weight: bold; } header a { color: var(--pine); font-weight: bold; text-decoration: none; }
        main { max-width: 900px; margin: auto; padding: 54px 24px 80px; }
        .eyebrow { color: #087f78; font-size: 12px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; }
        h1 { margin: 12px 0 30px; color: var(--navy); font-family: Georgia, serif; font-size: clamp(38px, 5vw, 60px); }
        .form-card { max-width: 680px; padding: clamp(24px, 5vw, 46px); border: 1px solid var(--line); border-radius: 12px; background: white; box-shadow: 0 14px 36px rgba(7, 27, 45, .08); }
        form { display: grid; gap: 20px; } label { display: grid; gap: 8px; color: #31545a; font-size: 13px; font-weight: bold; }
        input, textarea { width: 100%; padding: 13px 14px; border: 1px solid var(--line); border-radius: 7px; color: var(--ink); background: #fbfefd; font: inherit; outline: none; }
        textarea { min-height: 130px; resize: vertical; } input:focus, textarea:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(24, 183, 160, .16); }
        .fields { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; } button { padding: 14px 18px; border: 0; border-radius: 7px; color: white; background: var(--pine); font: inherit; font-weight: bold; cursor: pointer; }
        button:hover { background: #0d5b4b; } .actions { display: flex; align-items: center; gap: 16px; } .cancel { color: #087f78; font-weight: bold; text-decoration: none; }
        .error { padding: 12px 14px; border-radius: 8px; color: #8e2d2d; background: #fde9e4; margin-bottom: 20px; }
        @media (max-width: 600px) { header, main { padding-left: 18px; padding-right: 18px; } .fields { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header><div class="brand">NORTHSTAR / SUPPLY</div><a href="<?= site_url('logout') ?>">Log out</a></header>
    <main>
        <div class="eyebrow">Product workspace</div>
        <h1><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></h1>
        <section class="form-card">

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

            <form method="post" action="<?= htmlspecialchars($formAction, ENT_QUOTES, 'UTF-8') ?>">
                <label>Product name<input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" maxlength="100" required></label>
                <label>Description<textarea name="description" placeholder="Add a short description"><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea></label>
                <div class="fields"><label>Price<input type="number" name="price" value="<?= htmlspecialchars($product['price'] ?? '', ENT_QUOTES, 'UTF-8') ?>" min="0" step="0.01" required></label><label>Quantity<input type="number" name="quantity" value="<?= htmlspecialchars($product['quantity'] ?? '', ENT_QUOTES, 'UTF-8') ?>" min="0" step="1" required></label></div>
                <div class="actions"><button type="submit">Save product</button><a class="cancel" href="<?= site_url('products') ?>">Cancel</a></div>
            </form>
        </section>
    </main>
</body>
</html>
