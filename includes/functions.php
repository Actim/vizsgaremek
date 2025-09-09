<?php
    require_once("includes/config.php");

    session_start();
    $connection = new Database();

    function redirect($url, $statusCode = 302, $terminate = true) {
        if (headers_sent()) {
            echo '<script>window.location.href="' . htmlspecialchars($url) . '";</script>';
        } else {
            header('Location: ' . $url, true, $statusCode);
        }
        
        if ($terminate) {
            exit();
        }
    }

    function login($post) {
        global $connection;
        if (empty($post["username"]) || empty($post["password"])) {
            return ["success" => false, "message" => "Hiányzó adatok!"];
        }
        
        $usernameOrEmail = $post["username"];

        $stmt = $connection->prepare("
            SELECT * FROM accounts WHERE email = :email OR username = :username
        ");
        $stmt->execute([
            ":email" => $usernameOrEmail,
            ":username" => $usernameOrEmail
        ]);
        $account_data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($account_data && password_verify($post["password"], $account_data["password"])) {
            $_SESSION["USER:DATA"] = [
                "id" => $account_data["id"],
                "username" => $account_data["username"],
                "email" => $account_data["email"]
            ];
            $_SESSION["USER:LOGGED"] = true;

            $stmt = $connection->prepare("
                INSERT INTO login(accountId, session, ip) 
                VALUES(:id, :session, :ip)
            ");
            $stmt->bindParam(":id", $account_data["id"]);
            $stmt->bindValue(":session", session_id());
            $stmt->bindValue(":ip", $_SERVER['REMOTE_ADDR']);
            $stmt->execute();
            
            redirect("main");
        }

        return ["success" => false, "message" => "Hibás belépési adatok!"];
    }


    function register($post) {
        global $connection;
        
        if (empty($post["username"]) || empty($post["email"]) || empty($post["password"])) {
            return ["success" => false, "message" => "Hiányzó adatok!"];
        }

        $username = trim($post["username"]);
        $email = trim($post["email"]);
        $password = $post["password"];

        if ($post["password"] !== $post["password2"]) {
            return ["success" => false, "message" => "A jelszavak nem egyeznek!"];
        }
        
        
        $stmt = $connection->prepare("
            SELECT * FROM accounts WHERE email = :email OR username = :username
        ");
        $stmt->execute([
            ":email" => $email,
            ":username" => $username
        ]);
        if ($stmt->fetch()) {
            return ["success" => false, "message" => "Ez az email vagy felhasználónév már foglalt!"];
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connection->prepare("
            INSERT INTO accounts (username, email, password, regIp, regSession) 
            VALUES (:username, :email, :password, :ip, :session)
        ");
        $success = $stmt->execute([
            ":username" => $username,
            ":email" => $email,
            ":password" => $hashedPassword,
            ":ip" => $_SERVER['REMOTE_ADDR'],
            ":session" => session_id()
        ]);

        if ($success) {
            return ["success" => true, "message" => "Sikeres regisztráció!"];
        } else {
            return ["success" => false, "message" => "Hiba történt a regisztráció során!"];
        }
        
    }

    function logView(string $pageName) {
        global $connection;

        $accountId = null; // alapból nincs bejelentkezett felhasználó
        if (isset($_SESSION["USER:LOGGED"]) && $_SESSION["USER:LOGGED"] === true) {
            $accountId = $_SESSION["USER:DATA"]["id"];
        }

        try {
            $stmt = $connection->prepare("
                INSERT INTO views(accountId, session, ip, page)
                VALUES(:id, :session, :ip, :page)
            ");

            // Ha nincs felhasználó, accountId NULL lesz
            $stmt->bindValue(":id", $accountId, PDO::PARAM_INT);
            $stmt->bindValue(":session", session_id());
            $stmt->bindValue(":ip", $_SERVER['REMOTE_ADDR']);
            $stmt->bindValue(":page", $pageName);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Hiba a views beszúrásánál: " . $e->getMessage();
        }
    }

    
    function getAccountData($account_id) {
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM accounts WHERE id = :account_id");
        $stmt->bindParam(":account_id", $account_id);
        $stmt->execute();
        $account_data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $account_data;
    }
?>