<?php
require_once __DIR__ . '/../helpers/auth_guard.php';
require_once __DIR__ . '/../models/ProjectModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/TaskModel.php';
require_once __DIR__ . '/../models/DocumentModel.php';

class ProjectController {
    private $projectModel;
    private $userModel;

    public function __construct() {
        $this->projectModel = new ProjectModel();
        $this->userModel = new UserModel();
    }

    public function index() {
        require_login();
        $role = $_SESSION['user_role'];
        $user_id = $_SESSION['user_id'];

        if ($role === 'super_admin') {
            $projects = $this->projectModel->getAllProjects();
        } else if ($role === 'pm') {
            $projects = $this->projectModel->getProjectsByPM($user_id);
        } else if ($role === 'client') {
            $projects = $this->projectModel->getProjectsByClient($user_id);
        } else if ($role === 'programmer') {
            $projects = $this->projectModel->getProjectsByProgrammer($user_id);
        } else {
            $projects = [];
        }

        require_once __DIR__ . '/../views/projects/index.php';
    }

    public function create() {
        require_role(['pm', 'super_admin']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (validate_csrf_token($_POST['csrf_token'] ?? '')) {
                $data = [
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'client_id' => $_POST['client_id'],
                    'pm_id' => $_SESSION['user_id'], // Auto set PM to creator
                    'deadline' => $_POST['deadline']
                ];
                
                if (empty($data['title']) || empty($data['deadline'])) {
                    $error = "Title and Deadline are required.";
                } else {
                    $this->projectModel->createProject($data);
                    header("Location: /projects");
                    exit();
                }
            }
        }
        
        $clients = $this->userModel->getUsersByRole('client');
        require_once __DIR__ . '/../views/projects/create.php';
    }

    public function detail($id) {
        require_login();
        if (!$id) {
            die("Project ID missing");
        }
        
        $project = $this->projectModel->getProjectById($id);
        if (!$project) {
            http_response_code(404);
            die("Project Not Found");
        }

        // Check isolation
        $role = $_SESSION['user_role'];
        $user_id = $_SESSION['user_id'];
        if ($role === 'client' && $project['client_id'] != $user_id) {
            http_response_code(403);
            die("Forbidden");
        }
        if ($role === 'pm' && $project['pm_id'] != $user_id && $role !== 'super_admin') {
            http_response_code(403);
            die("Forbidden");
        }

        // Get related tasks and documents
        $taskModel = new TaskModel();
        $tasks = $taskModel->getTasksByProject($id);
        
        $docModel = new DocumentModel();
        $documents = $docModel->getDocumentsByProject($id);
        
        $programmers = $this->userModel->getUsersByRole('programmer');

        require_once __DIR__ . '/../views/projects/detail.php';
    }
}
