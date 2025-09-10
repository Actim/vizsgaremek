<?php
$banData = getBanDataById($_SESSION["USER:DATA"]["id"]);
$admin_data = getAccountData($banData["bannedBy"]);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kitíltás</title>
    <style>
        body {
            background-color: #2c2c2c;
            color: #ff4d4d;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            margin: 0;
        }
        .banned-box {
            background-color: #1a1a1a;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }
        h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        p {
            font-size: 20px;
            margin: 10px 0;
            color: white;
        }
        a{
            color: #c5c5c5ff;
        }
    </style>
</head>
<body>
    <div class="banned-box">
        <h1>Ki lettél tiltva az oldalról!</h1>
        <p><strong>Indok:</strong> <?= htmlspecialchars($banData["reason"]) ?></p>
        <p><strong>Általa:</strong> <?= htmlspecialchars($admin_data["username"]) ?></p>
        <p><strong>Dátum:</strong> <?= htmlspecialchars($banData["date"]) ?></p>
        <br>
        <p><i>Amennyiben nem érzed jogosnak a kitíltásod, keress fel minket az email címünkön.</i></p>
        <p><strong><a href="mailto:info@horgaszelet.hu">info@horgaszelet.hu</a></strong></p>
    </div>
</body>
</html>