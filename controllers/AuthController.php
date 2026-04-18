<?php
require_once __DIR__ . '/../helpers/auth_guard.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        if (is_logged_in()) {
            header("Location: /dashboard");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
                $error = "Invalid CSRF token.";
            } else {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';

                if (empty($email) || empty($password)) {
                    $error = "Email and password are required.";
                } else {
                    $user = $this->userModel->authenticate($email, $password);
                    if ($user) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_name'] = $user['name'];
                        $_SESSION['user_role'] = $user['role'];
                        $_SESSION['user_avatar'] = $user['avatar'];
                        
                        log_activity('LOGIN', 'users', $user['id']);
                        header("Location: /dashboard");
                        exit();
                    } else {
                        $error = "Invalid credentials.";
                    }
                }
            }
        }
        
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        if (is_logged_in()) {
            log_activity('LOGOUT', 'users', $_SESSION['user_id']);
        }
        session_destroy();
        header("Location: /auth/login");
        exit();
    }
}
