<?php
require_once __DIR__ . '/../helpers/auth_guard.php';
require_once __DIR__ . '/../models/ProjectModel.php';

class ReportController {
    private $projectModel;

    public function __construct() {
        $this->projectModel = new ProjectModel();
    }

    public function project($id) {
        require_login();
        if (!$id) die("Project ID required");
        
        $project = $this->projectModel->getProjectById($id);
        if (!$project) {
            http_response_code(404);
            die("Project Not Found");
        }
        
        $role = $_SESSION['user_role'];
        $user_id = $_SESSION['user_id'];
        
        if ($role === 'client' && $project['client_id'] != $user_id) {
            die("Forbidden");
        }
        if ($role === 'pm' && $project['pm_id'] != $user_id && $role !== 'super_admin') {
            die("Forbidden");
        }
        
        require_once __DIR__ . '/../views/reports/project_report.php';
    }
}
