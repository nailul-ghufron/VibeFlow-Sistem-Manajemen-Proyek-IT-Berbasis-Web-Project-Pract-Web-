<?php
require_once __DIR__ . '/../helpers/auth_guard.php';
require_once __DIR__ . '/../models/TaskModel.php';
require_once __DIR__ . '/../models/ProjectModel.php';

class TaskController {
    private $taskModel;
    private $projectModel;

    public function __construct() {
        $this->taskModel = new TaskModel();
        $this->projectModel = new ProjectModel();
    }

    public function create() {
        require_role(['pm', 'super_admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (validate_csrf_token($_POST['csrf_token'] ?? '')) {
                $data = [
                    'project_id' => $_POST['project_id'],
                    'programmer_id' => $_POST['programmer_id'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'priority' => $_POST['priority'] ?? 'medium',
                    'due_date' => !empty($_POST['due_date']) ? $_POST['due_date'] : null
                ];
                
                $this->taskModel->createTask($data);
                $this->projectModel->recalculateProgress($data['project_id']);
                
                header("Location: /projects/detail/" . $data['project_id']);
                exit();
            }
        }
    }

    public function update_status() {
        require_role(['programmer', 'pm', 'super_admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if ($input && isset($input['task_id']) && isset($input['new_status'])) {
                $task = $this->taskModel->getTaskById($input['task_id']);
                if ($task) {
                    $this->taskModel->updateTaskStatus($input['task_id'], $input['new_status']);
                    $progress = $this->projectModel->recalculateProgress($task['project_id']);
                    
                    log_activity('UPDATE_TASK_STATUS', 'tasks', $input['task_id'], ['status' => $task['status']], ['status' => $input['new_status']]);
                    
                    echo json_encode(['success' => true, 'progress' => $progress]);
                    exit();
                }
            }
        }
        echo json_encode(['success' => false]);
        exit();
    }
}
