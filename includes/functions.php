<?php
    require_once("includes/config.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // PHPMailer betöltése
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    require 'phpmailer/Exception.php';

    session_start();
    $connection = new Database();

    function loadTemplate($templateFile, $data = []) {
        // egy szinttel feljebb megyünk
        $path = __DIR__ . "/../mailTemplates/" . $templateFile;

        if (!file_exists($path)) {
            die("❌ Sablon nem található: " . $path);
        }

        $template = file_get_contents($path);

        foreach ($data as $key => $value) {
            $template = str_replace("{{" . strtolower($key) . "}}", $value, $template);
            $template = str_replace("{{" . strtoupper($key) . "}}", $value, $template);
        }

        return $template;
    }



    function sendEmail($to, $subject, $templateFile, $data = []) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'mail.horgaszelet.hu';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'noreply@horgaszelet.hu';
            $mail->Password   = 'gBEuspi@#_y(LXC{';
            $mail->SMTPSecure = 'ssl'; // ha nem megy, próbáld tls+587
            $mail->Port       = 465;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('noreply@horgaszelet.hu', 'Horgászélet');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;

            // Betöltjük és helyettesítjük a sablont
            $mail->Body = loadTemplate($templateFile, $data);

            // Sima szöveges változat (opcionális)
            $mail->AltBody = 'Kérlek, nyisd meg az emailt HTML kompatibilis kliensben.';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Hiba az email küldésekor: {$mail->ErrorInfo}";
        }
    }

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

        if ($account_data) {
            // Ellenőrizzük a státuszt
            if ($account_data["status"] == 0) {
                // Visszaadjuk a fiók ID-t az újraküldéshez
                return [
                    "success" => false,
                    "message" => "A fiók még nincs aktiválva, nézze meg az emailjeit, vagy küldje ki újra.",
                    "accountId" => $account_data["id"]
                ];
            }

            // Jelszó ellenőrzése
            if (password_verify($post["password"], $account_data["password"])) {
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
            $accountId = $connection->lastInsertId(); // <-- beszúrt felhasználó ID-je
            
            $token = bin2hex(random_bytes(16));
            $activationLink = "https://horgaszelet.hu/activate/{$token}";
            
            $stmt = $connection->prepare("
                INSERT INTO accountactivation (accountId, token, expiredAt) 
                VALUES (:accountId, :token, (NOW() + INTERVAL 1 HOUR))
            ");
            $stmt->execute([
                ":accountId" => $accountId,
                ":token" => $token
            ]);

            $result = sendEmail(
                $email,
                "Horgászélet.hu - Regisztráció megerősítése",
                "activation.html",
                [
                    "username" => $username,
                    "link" => $activationLink
                ]
            );

            if ($result === true) {
                return ["success" => true, "message" => "Sikeres regisztráció! Ellenőrizd az emailed az aktiváláshoz!"];
            } else {
                return ["success" => false, "message" => $result];
            }
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
    
    function getAllViewsByDay($day){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM views
WHERE date >= (CURDATE() - INTERVAL :day DAY )");
        $stmt->bindParam(":day", $day);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }
    
    function getAllLoginsByDay($day){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM login
WHERE date >= (CURDATE() - INTERVAL :day DAY )");
        $stmt->bindParam(":day", $day);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }
    
    function getAllUsers(){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM accounts");
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    
    function getAccountData($account_id) {
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM accounts WHERE id = :account_id");
        $stmt->bindParam(":account_id", $account_id);
        $stmt->execute();
        $account_data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $account_data;
    }
    
    function getAllAccounts(){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM accounts");
        $stmt->execute();
        $data = $stmt->fetchAll();

        foreach ($data as $data_query){
            $lastLoginData = getLastLoginData($data_query["id"]);
            $bandata = getBanDataById($data_query["id"]);
            $allLogins = getAllLogins($data_query["id"]);
            $allViews = getAllViews($data_query["id"]);

            // modal tartalom előre generálva, rejtett div
            $modalHtml = "<div class='user-modal-content' id='modalUser{$data_query['id']}' style='display:none;'>";
            foreach ($allLogins as $login){
                $modalHtml .= "<b>Dátum:</b> {$login['date']}<br><b>IP:</b> {$login['ip']}<br><b>Session:</b> {$login['session']}<hr>";
            }
            $modalHtml .= "</div>";

            // modal tartalom a megtekintésekhez
            $viewsModalHtml = "<div class='user-modal-content' id='viewsModalUser{$data_query['id']}' style='display:none;'>";
            foreach ($allViews as $view){
                $viewsModalHtml .= "<b>Dátum:</b> {$view['date']}<br><b>Oldal:</b> {$view['page']}<hr>";
            }
            $viewsModalHtml .= "</div>";

            // kitíltás gomb státusz szerint
            $isBanned = $bandata && $bandata["status"] == 0;

            echo "
                <tr>
                    <td>{$data_query['id']}</td>
                    <td>{$data_query['username']}</td>
                    <td>{$data_query['fullname']}</td>
                    <td>{$data_query['email']}</td>
                    <td>{$lastLoginData['date']}</td>
                    <td>{$lastLoginData['ip']}</td>
                    <td>{$lastLoginData['session']}</td>
                    <td>{$data_query['regDate']}</td>
                    <td>
                        <div class='btn-group'>
                            <a class='btn btn-primary' href='editUser/{$data_query['id']}'><i class='fa-solid fa-pen-to-square'></i> Szerkesztés</a>
                            <a href='#' class='openModalLink btn btn-info' data-userid='{$data_query['id']}'><i class='fa-solid fa-info'></i> Bejelentkezések</a>
                            <a href='#' class='openViewsModalLink btn btn-success' data-userid='{$data_query['id']}'><i class='fa-solid fa-eye'></i> Megtekintések</a>
                            <button class='btn btn-danger suspendBtn' data-userid='{$data_query['id']}'>
                                <i class='fa-solid fa-ban'></i> " . ($isBanned ? "Feloldás" : "Kitíltás") . "
                            </button>
                        </div>
                    </td>
                </tr>
                {$modalHtml}
                {$viewsModalHtml}
            ";
        }
    }

    function editUser($post, $id) {
        global $connection;
        if (empty($post["name"]) || empty($post["email"])) {
            return ["success" => false, "message" => "Hiányzó adatok!"];
        }
        
        $old_data = getAccountData($id);

        $name = $post["name"];
        $email = $post["email"];
        $fullname = $post["fullname"];
        $status = $post["status"];
        
        $stmt = $connection->prepare("
            UPDATE accounts SET username = :name, email = :email, fullname = :fullname, status = :status WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":fullname", $fullname);
        $stmt->bindParam(":status", $status);
        $stmt->execute();

        $stmt = $connection->prepare("
            INSERT INTO accountArchive(accountId, editedBy, oldUsername, oldEmail, oldFullname, oldStatus, newUsername, newEmail, newFullname, newStatus) VALUES(:accountId, :editedBy, :oldUsername, :oldEmail, :oldFullname, :oldStatus, :newUsername, :newEmail, :newFullname, :newStatus)
        ");
        $stmt->bindParam(":accountId", $id);
        $stmt->bindParam(":editedBy", $_SESSION["USER:DATA"]["id"]);
        $stmt->bindParam(":oldUsername", $old_data["username"]);
        $stmt->bindParam(":oldEmail", $old_data["email"]);
        $stmt->bindParam(":oldFullname", $old_data["fullname"]);
        $stmt->bindParam(":oldStatus", $old_data["status"]);
        $stmt->bindParam(":newUsername", $name);
        $stmt->bindParam(":newEmail", $email);
        $stmt->bindParam(":newFullname", $fullname);
        $stmt->bindParam(":newStatus", $status);
        $stmt->execute();
        redirect("{$id}");
        return ["success" => true, "message" => "Sikeres jogosultság hozzáadás."];
    }



    function banUser($userId, $reason){
        global $connection;
        $lastIp = getLastLoginData($userId)["ip"];
        $lastSession = getLastLoginData($userId)["session"];
        $stmt = $connection->prepare("INSERT INTO bans (accountId, reason, ip, session, bannedBy) VALUES (:id, :reason, :ip, :session, :bannedBy)");
        $stmt->bindParam(':id', $userId);
        $stmt->bindParam(':reason', $reason);
        $stmt->bindParam(':ip', $lastIp);
        $stmt->bindParam(':session', $lastSession);
        $stmt->bindParam(':bannedBy', $_SESSION["USER:DATA"]["id"]);
        return $stmt->execute();
    }

    function unbanUser($userId){
        global $connection;
        // Frissítjük a bans táblát, vagy törölhetjük a kitíltást
        $stmt = $connection->prepare("UPDATE bans SET status = 1 WHERE accountId = :id AND status = 0");
        $stmt->bindParam(":id", $userId);
        return $stmt->execute();
    }


    function getBanDataById($id){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM bans WHERE accountId = :id AND status = 0 ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function getLastLoginData($id){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM login WHERE accountId = :id ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function getAllLogins($id){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM login WHERE accountId = :id ORDER BY date DESC LIMIT 10");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // <-- itt már tömböt kapunk minden loginról
        return $data;
    }

    function getAllViews($id){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM views WHERE accountId = :id ORDER BY date DESC LIMIT 10");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    function getAllRoles(){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM roles ORDER BY piority DESC");
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach ($data as $data_query){
            echo "
                <tr>
                    <td>{$data_query['name']}</td>
                    <td>{$data_query['piority']}</td>
                    <td><a class='btn btn-primary' href='editRole/{$data_query['id']}'><i class='fa-solid fa-pen-to-square'></i> Szerkesztés</a></td>
                </tr>
            ";
        }
    }

    function createRole($post) {
        global $connection;
        if (empty($post["name"]) || empty($post["piority"])) {
            return ["success" => false, "message" => "Hiányzó adatok!"];
        }
        
        $name = $post["name"];
        $css = $post["css"];
        $piority = $post["piority"];
        
        $stmt = $connection->prepare("
            INSERT INTO roles(name, css, piority) 
            VALUES(:name, :css, :piority)
        ");
        $stmt->bindParam(":name", $name);
        $stmt->bindValue(":css", $css);
        $stmt->bindValue(":piority", $piority);
        $stmt->execute();
        return ["success" => true, "message" => "Sikeres jogosultság hozzáadás."];
    }
    function editRole($post, $id) {
        global $connection;
        if (empty($post["name"]) || empty($post["piority"])) {
            return ["success" => false, "message" => "Hiányzó adatok!"];
        }
        
        $name = $post["name"];
        $css = $post["css"];
        $piority = $post["piority"];
        $perms = json_encode($post["permissions"]);
        
        $stmt = $connection->prepare("
            UPDATE roles SET name = :name, css = :css, piority = :piority, perms = :perms WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindValue(":css", $css);
        $stmt->bindValue(":piority", $piority);
        $stmt->bindValue(":perms", $perms);
        $stmt->execute();
        redirect("{$id}");
        return ["success" => true, "message" => "Sikeres jogosultság hozzáadás."];
    }

    function getRoleData($id) {
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function activateAccount($token){
        global $connection;
        $stmt = $connection->prepare("SELECT * FROM accountactivation WHERE token = :token AND status = 0 AND expiredAt > NOW()");
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach ($data as $data_query){
            $stmt = $connection->prepare("UPDATE accountactivation SET status = 1, activated = NOW() WHERE id = :id");
            $stmt->bindParam(":id", $data_query["id"]);
            $stmt->execute();

            $stmt = $connection->prepare("UPDATE accounts SET status = 1 WHERE id = :id");
            $stmt->bindParam(":id", $data_query["accountId"]);
            $stmt->execute();
        }
        redirect("../login");
    }

    function sendRegistrationMail($post){
        global $connection;
        $accountId = $post["accountId"];
        $account_data = getAccountData($accountId);
            
        $token = bin2hex(random_bytes(16));
        $activationLink = "https://horgaszelet.hu/activate/{$token}";
        
        $stmt = $connection->prepare("
            INSERT INTO accountactivation (accountId, token, expiredAt) 
            VALUES (:accountId, :token, (NOW() + INTERVAL 1 HOUR))
        ");
        $stmt->execute([
            ":accountId" => $accountId,
            ":token" => $token
        ]);

        $result = sendEmail(
            $account_data["email"],
            "Horgászélet.hu - Regisztráció megerősítése",
            "activation.html",
            [
                "username" => $account_data["username"],
                "link" => $activationLink
            ]
        );

        if ($result === true) {
            return ["success" => true, "message" => "Megerősítő email újból küldve."];
        } else {
            return ["success" => false, "message" => $result];
        }
    }
?>