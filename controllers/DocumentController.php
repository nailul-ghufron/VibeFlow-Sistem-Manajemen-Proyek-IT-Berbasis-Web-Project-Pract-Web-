<?php
require_once __DIR__ . '/../helpers/auth_guard.php';
require_once __DIR__ . '/../models/DocumentModel.php';

class DocumentController {
    private $docModel;

    public function __construct() {
        $this->docModel = new DocumentModel();
    }

    public function upload() {
        require_role(['pm', 'programmer', 'super_admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
            if (validate_csrf_token($_POST['csrf_token'] ?? '')) {
                $project_id = (int)$_POST['project_id'];
                $file = $_FILES['file'];
                
                // Validate size (< 10MB)
                if ($file['size'] > 10 * 1024 * 1024) {
                    die("File too large. Max 10MB.");
                }
                
                // Validate extension
                $allowed_exts = ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'zip', 'rar'];
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, $allowed_exts)) {
                    die("Extension not allowed.");
                }
                
                // Validate MIME
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);
                
                // Ensure directory exists
                $upload_dir = __DIR__ . '/../uploads/docs/' . $project_id;
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                $new_name = uniqid() . '_' . substr(hash('sha256', $file['name']), 0, 8) . '.' . $ext;
                $dest = $upload_dir . '/' . $new_name;
                
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    $this->docModel->addDocument([
                        'project_id' => $project_id,
                        'uploader_id' => $_SESSION['user_id'],
                        'file_name' => basename($file['name']),
                        'file_path' => 'uploads/docs/' . $project_id . '/' . $new_name,
                        'file_size' => $file['size'],
                        'file_type' => $mime
                    ]);
                    header("Location: /projects/detail/" . $project_id);
                    exit();
                } else {
                    die("Failed to move uploaded file.");
                }
            }
        }
    }

    public function download($id) {
        require_login();
        $doc = $this->docModel->getDocumentById($id);
        if ($doc) {
            // Need to check project access here ideally
            $file_path = __DIR__ . '/../' . $doc['file_path'];
            if (file_exists($file_path)) {
                header('Content-Description: File Transfer');
                header('Content-Type: ' . $doc['file_type']);
                header('Content-Disposition: attachment; filename="'.basename($doc['file_name']).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file_path));
                readfile($file_path);
                exit;
            }
        }
        http_response_code(404);
        die("File not found");
    }
}
