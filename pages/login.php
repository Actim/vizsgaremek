<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vízi Bejelentkezés</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body {
            display: flex; justify-content: center; align-items: center; min-height: 100vh;
            background: linear-gradient(135deg, #0a3d62, #079992, #0a3d62); overflow: hidden; position: relative;
        }
        .light-beam {
            position: absolute; top: 0; width: 100px; height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.1) 40%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.1) 60%, transparent);
            transform: rotate(20deg); animation: beam 15s infinite linear; z-index: 1; opacity: 0.5;
        }
        .light-beam:nth-child(2) { left: 25%; animation-delay: 3s; animation-duration: 17s; width: 150px; }
        .light-beam:nth-child(3) { left: 60%; animation-delay: 7s; animation-duration: 20s; width: 80px; }
        @keyframes beam { 0% { top: -100%; } 100% { top: 100%; } }

        .bubbles { position: absolute; width: 100%; height: 100%; z-index: 1; overflow: hidden; }
        .bubble {
            position: absolute; bottom: -100px; width: 40px; height: 40px;
            background: rgba(255, 255, 255, 0.1); border-radius: 50%; opacity: 0.5; animation: rise 15s infinite ease-in;
        }
        @keyframes rise {
            0% { bottom: -100px; transform: translateX(0) rotate(0deg); opacity: 0.5; }
            50% { transform: translateX(50px) rotate(180deg); opacity: 0.3; }
            100% { bottom: 1080px; transform: translateX(-50px) rotate(360deg); opacity: 0; }
        }

        .login-container {
            background: rgba(255,255,255,0.9); padding: 40px; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            width: 100%; max-width: 400px; transform: scale(0.9); opacity: 0; animation: fadeIn 0.8s forwards; z-index: 2; position: relative;
        }
        @keyframes fadeIn { to { opacity: 1; transform: scale(1); } }
        h2 { text-align: center; margin-bottom: 25px; color: #0a3d62; font-weight: 600; font-size: 28px; }
        .input-group { margin-bottom: 20px; position: relative; }
        .input-group input { width: 100%; padding: 15px 15px 15px 45px; border: none; background: #f2f2f2; border-radius: 30px; outline: none; font-size: 16px; transition: all 0.3s ease; }
        .input-group input:focus { background: #e6e6e6; box-shadow: 0 0 10px rgba(10, 61, 98, 0.3); }
        .input-group i { position: absolute; left: 15px; top: 15px; color: #0a3d62; font-size: 18px; }
        .btn { width: 100%; padding: 15px; border: none; border-radius: 30px; background: linear-gradient(135deg, #0a3d62, #079992); color: white; font-size: 16px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.3); background: linear-gradient(135deg, #079992, #0a3d62); }
        .btn:active { transform: translateY(1px); }
        .links { display: flex; justify-content: space-between; margin-top: 20px; }
        .links a { color: #0a3d62; text-decoration: none; font-size: 14px; transition: color 0.3s ease; }
        .links a:hover { color: #079992; text-decoration: underline; }
        @media (max-width: 480px) { .login-container { padding: 30px 20px; } h2 { font-size: 24px; } }
        .error { color: red; text-align: center; margin-top: 10px; }
        .success { color: green; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="light-beam"></div>
    <div class="light-beam"></div>
    <div class="light-beam"></div>

    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <?php
    // --- PHP LOGIKA ---
    $activationAccountId = null;

    // Login gomb POST
    if (isset($_POST["loginBtn"])) {
        $result = login($_POST); // Feltételezzük, hogy van login() függvényed
        if (!$result["success"]) {
            echo "<p class='error'>" . htmlspecialchars($result["message"]) . "</p>";
            if (isset($result["accountId"])) {
                $activationAccountId = $result["accountId"];
            }
        }
    }

    // Aktiváló email újraküldés POST
    if (isset($_POST["resend_activation"])) {
        $activationAccountId = $_POST["accountId"];
        $result = sendRegistrationMail($_POST); // Feltételezzük, hogy van sendRegistrationMail() függvényed
        if (!$result["success"]) {
            echo "<p class='error'>" . htmlspecialchars($result["message"]) . "</p>";
        } else {
            echo "<p class='success'>Aktiváló email elküldve!</p>";
        }
    }
    ?>

    <div class="login-container">
        <h2>Bejelentkezés</h2>
        <form method="POST" action="">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Felhasználónév vagy email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Jelszó" required>
            </div>
            <button type="submit" name="loginBtn" class="btn">Bejelentkezés</button>

            <div class="links">
                <a href="#">Elfelejtett jelszó?</a>
                <a href="register">Regisztráció</a>
            </div>
        </form>

        <?php if ($activationAccountId): ?>
        <form method="POST">
            <input type="hidden" name="accountId" value="<?= htmlspecialchars($activationAccountId) ?>">
            <button type="submit" name="resend_activation" class="btn" style="margin-top:10px; background: #079992;">Aktiváló email újraküldése</button>
        </form>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bubblesContainer = document.querySelector('.bubbles');
            for (let i = 0; i < 15; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('bubble');
                const size = Math.random() * 30 + 10;
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.animationDuration = `${Math.random() * 10 + 8}s`;
                bubble.style.animationDelay = `${Math.random() * 5}s`;
                bubblesContainer.appendChild(bubble);
            }
        });
    </script>
</body>
</html>
