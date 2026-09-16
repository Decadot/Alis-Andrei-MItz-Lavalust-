<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account | Northstar Supply</title>
    <style>
        :root { --navy: #071b2d; --pine: #123f36; --teal: #18b7a0; --mint: #d9f4eb; --ink: #102d3d; --line: #c9e4dc; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; padding: 24px; color: var(--ink); font-family: "Trebuchet MS", sans-serif; background: radial-gradient(circle at 84% 12%, #1b6154 0, transparent 32%), linear-gradient(135deg, var(--navy), #0c3040 58%, var(--pine)); }
        .shell { width: min(940px, 100%); display: grid; grid-template-columns: .9fr 1.1fr; overflow: hidden; border: 1px solid rgba(217, 244, 235, .2); border-radius: 18px; box-shadow: 0 24px 70px rgba(0, 0, 0, .28); background: #f4fbf8; }
        .intro { display: flex; flex-direction: column; justify-content: space-between; min-height: 600px; padding: 42px; color: var(--mint); background: linear-gradient(155deg, #0d3442, var(--pine)); }
        .eyebrow { color: var(--teal); font-size: 12px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; }
        .intro h1 { max-width: 280px; margin: 46px 0 16px; color: white; font-family: Georgia, serif; font-size: clamp(36px, 5vw, 58px); line-height: .98; }
        .intro p { max-width: 270px; color: #b8dcd2; line-height: 1.7; }
        .mark { color: white; font-family: Georgia, serif; font-size: 20px; }
        .card { padding: 48px clamp(28px, 6vw, 68px); }
        h2 { margin: 0 0 8px; color: var(--navy); font-family: Georgia, serif; font-size: 34px; }
        .subtle { margin: 0 0 28px; color: #5c7776; }
        form { display: grid; gap: 15px; }
        label { display: grid; gap: 7px; color: #31545a; font-size: 13px; font-weight: bold; }
        input { width: 100%; padding: 12px 14px; border: 1px solid var(--line); border-radius: 8px; color: var(--ink); background: white; font: inherit; outline: none; }
        input:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(24, 183, 160, .16); }
        button { margin-top: 5px; padding: 14px 18px; border: 0; border-radius: 8px; color: white; background: var(--pine); font: inherit; font-weight: bold; cursor: pointer; }
        button:hover { background: #0d5b4b; }
        .error, .success { padding: 12px 14px; border-radius: 8px; margin-bottom: 18px; }
        .error { color: #8e2d2d; background: #fde9e4; }
        .success { color: #17644d; background: #ddf5e8; }
        .link { display: inline-block; margin-top: 22px; color: #087f78; font-weight: bold; text-decoration: none; }
        .link:hover { text-decoration: underline; }
        @media (max-width: 700px) { .shell { grid-template-columns: 1fr; } .intro { min-height: auto; padding: 30px; } .intro h1 { margin: 32px 0 12px; font-size: 42px; } .intro p { margin-bottom: 0; } .card { padding: 34px 28px 38px; } }
    </style>
</head>
<body>
    <main class="shell">
        <section class="intro">
            <div class="mark">NORTHSTAR / SUPPLY</div>
            <div><div class="eyebrow">Start organized</div><h1>Your stock, in focus.</h1><p>Create an account and bring your product workspace into view.</p></div>
            <div class="eyebrow">Product operations</div>
        </section>
        <section class="card">
            <h2>Create your account</h2>
            <p class="subtle">Set up your access in a few quick details.</p>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

            <form method="post" action="<?= site_url('signup') ?>">
                <label>Full name<input type="text" name="name" placeholder="Your name" required></label>
                <label>Username<input type="text" name="username" placeholder="Choose a username" required></label>
                <label>Password<input type="password" name="password" placeholder="Create a password" required></label>
                <label>Confirm password<input type="password" name="confirm_password" placeholder="Repeat your password" required></label>
                <button type="submit">Create account</button>
            </form>

            <a class="link" href="<?= site_url('login') ?>">Already have an account? Sign in</a>
        </section>
    </main>
</body>
</html>
