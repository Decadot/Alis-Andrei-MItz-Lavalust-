<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Northstar Supply</title>
    <style>
        :root { --navy: #071b2d; --pine: #123f36; --teal: #18b7a0; --mint: #d9f4eb; --ink: #102d3d; --muted: #6a8582; --paper: #f4fbf8; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; color: var(--ink); font-family: "Trebuchet MS", sans-serif; background: radial-gradient(circle at 85% 0, #d9f4eb 0, transparent 28%), var(--paper); }
        header { display: flex; align-items: center; justify-content: space-between; max-width: 1180px; margin: auto; padding: 28px 24px; }
        .brand { color: var(--navy); font-family: Georgia, serif; font-size: 20px; font-weight: bold; }
        header a { color: var(--pine); font-weight: bold; text-decoration: none; }
        main { max-width: 1180px; margin: auto; padding: 62px 24px; }
        .eyebrow { color: #087f78; font-size: 12px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; }
        h1 { max-width: 700px; margin: 14px 0 18px; color: var(--navy); font-family: Georgia, serif; font-size: clamp(42px, 7vw, 82px); line-height: .98; }
        .lead { max-width: 560px; color: var(--muted); font-size: 18px; line-height: 1.6; }
        .action { display: inline-flex; align-items: center; gap: 12px; margin-top: 24px; padding: 15px 20px; border-radius: 8px; color: white; background: var(--pine); font-weight: bold; text-decoration: none; }
        .action:hover { background: #0d5b4b; }
        .arrow { color: var(--teal); font-size: 20px; }
        .strip { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; margin-top: 100px; border-top: 1px solid #c9e4dc; border-bottom: 1px solid #c9e4dc; }
        .stat { padding: 24px 0; }
        .stat strong { display: block; color: var(--navy); font-family: Georgia, serif; font-size: 28px; }
        .stat span { color: var(--muted); font-size: 13px; }
        @media (max-width: 600px) { header { padding: 22px 18px; } main { padding: 46px 18px; } .strip { margin-top: 65px; } .stat strong { font-size: 22px; } }
    </style>
</head>
<body>
    <header><div class="brand">NORTHSTAR / SUPPLY</div><a href="<?= site_url('logout') ?>">Log out</a></header>
    <main>
        <div class="eyebrow">Operations dashboard</div>
        <h1>Good to see you, <?= htmlspecialchars($username) ?>.</h1>
        <p class="lead">Your inventory workspace is ready. Keep product details current and make every stock decision with confidence.</p>
        <a class="action" href="<?= site_url('products') ?>">Open product management <span class="arrow">&#8594;</span></a>
        <div class="strip"><div class="stat"><strong>Products</strong><span>One focused catalog</span></div><div class="stat"><strong>Live data</strong><span>Connected to Aiven MySQL</span></div><div class="stat"><strong>CRUD ready</strong><span>Create, edit, remove</span></div></div>
    </main>
</body>
</html>
