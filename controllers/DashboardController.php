<?php
require_once __DIR__ . '/../helpers/auth_guard.php';

class DashboardController {
    public function index() {
        require_login();
        $role = $_SESSION['user_role'];

        // Ambil data statistik jika role adalah PM atau Super Admin
        $stats = null;
        if ($role === 'pm' || $role === 'super_admin') {
            require_once __DIR__ . '/../models/ProjectModel.php';
            $projectModel = new ProjectModel();
            $stats = $projectModel->getDashboardStats();
        }
        
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
