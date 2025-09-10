<?php
// --- AJAX POST feldolgozás a kitíltáshoz/feloldáshoz ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $userId = $_POST['userId'] ?? null;

    if (!$userId) {
        echo json_encode(["success" => false, "message" => "Hiányzó felhasználó ID."]);
        exit;
    }

    $action = $_POST['action'];

    switch($action){
        case 'editUser':
            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;
            $fullname = $_POST['fullname'] ?? null;

            if ($userId && $username && $email && $fullname) {
                $success = editUser($userId, $username, $email, $fullname);
                echo json_encode(["success" => $success, "message" => $success ? "Felhasználó frissítve!" : "Hiba történt az adatbázisban."]);
            } else {
                echo json_encode(["success" => false, "message" => "Hiányzó adatok!"]);
            }
            break;

        case 'banUser':
            $reason = $_POST['reason'] ?? null;
            if (!$reason) {
                echo json_encode(["success" => false, "message" => "Hiányzó indok."]);
                exit;
            }
            $success = banUser($userId, $reason);
            echo json_encode(["success" => $success, "status" => "banned", "message" => $success ? "Felhasználó kitíltva." : "Hiba történt a kitíltás során."]);
            break;

        case 'unbanUser':
            $success = unbanUser($userId);
            echo json_encode(["success" => $success, "status" => "active", "message" => $success ? "Felhasználó feloldva." : "Hiba történt a feloldás során."]);
            break;

        default:
            echo json_encode(["success" => false, "message" => "Ismeretlen művelet."]);
            break;
    }
    exit;
}
?>