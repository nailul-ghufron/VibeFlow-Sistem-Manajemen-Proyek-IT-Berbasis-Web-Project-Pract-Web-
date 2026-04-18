<?php
// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Strict'
    ]);
}

/**
 * Check if the user is logged in
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Guard route: redirect to login if not logged in
 */
function require_login() {
    if (!is_logged_in()) {
        header("Location: /auth/login");
        exit();
    }
}

/**
 * Require specific role
 * @param array|string $roles Allowed roles
 */
function require_role($roles) {
    require_login();
    $user_role = $_SESSION['user_role'] ?? '';
    
    if (is_array($roles)) {
        if (!in_array($user_role, $roles)) {
            http_response_code(403);
            die("403 Forbidden - You do not have permission to access this resource.");
        }
    } else {
        if ($user_role !== $roles) {
            http_response_code(403);
            die("403 Forbidden - You do not have permission to access this resource.");
        }
    }
}

/**
 * Generate CSRF Token
 */
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate CSRF Token
 */
function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Log activity to database
 */
function log_activity($action, $target_table, $target_id, $old_value = null, $new_value = null) {
    require_once __DIR__ . '/../config/database.php';
    $db = Database::getConnection();
    
    $user_id = $_SESSION['user_id'] ?? 0;
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    
    $stmt = $db->prepare("INSERT INTO activity_logs (user_id, action, target_table, target_id, old_value, new_value, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $old_json = $old_value ? json_encode($old_value) : null;
    $new_json = $new_value ? json_encode($new_value) : null;
    
    $stmt->execute([$user_id, $action, $target_table, $target_id, $old_json, $new_json, $ip_address]);
}
