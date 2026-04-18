<?php
require_once __DIR__ . '/../helpers/auth_guard.php';

class DashboardController {
    public function index() {
        require_login();
        $role = $_SESSION['user_role'];
        
        switch ($role) {
            case 'pm':
            case 'super_admin':
                require_once __DIR__ . '/../views/dashboard/pm.php';
                break;
            case 'programmer':
                require_once __DIR__ . '/../views/dashboard/programmer.php';
                break;
            case 'client':
                require_once __DIR__ . '/../views/dashboard/client.php';
                break;
            default:
                echo "Invalid Role";
                break;
        }
    }
}
