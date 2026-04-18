<?php
require_once __DIR__ . '/../config/database.php';

class DocumentModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getDocumentsByProject($project_id) {
        $stmt = $this->db->prepare("SELECT d.*, u.name as uploader_name FROM documents d 
                                    JOIN users u ON d.uploader_id = u.id 
                                    WHERE d.project_id = ? ORDER BY d.uploaded_at DESC");
        $stmt->execute([$project_id]);
        return $stmt->fetchAll();
    }

    public function getDocumentById($id) {
        $stmt = $this->db->prepare("SELECT * FROM documents WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function addDocument($data) {
        $stmt = $this->db->prepare("INSERT INTO documents (project_id, uploader_id, file_name, file_path, file_size, file_type) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['project_id'],
            $data['uploader_id'],
            $data['file_name'],
            $data['file_path'],
            $data['file_size'],
            $data['file_type']
        ]);
        return $this->db->lastInsertId();
    }

    public function deleteDocument($id) {
        $stmt = $this->db->prepare("DELETE FROM documents WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
