<?php
session_start();

// Simple Router
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url_parts = explode('/', $url);

$controller_name = isset($url_parts[0]) && $url_parts[0] != '' ? $url_parts[0] : 'dashboard';
$action_name = isset($url_parts[1]) ? $url_parts[1] : 'index';

// Map controller paths
$controllers_map = [
    'auth' => 'AuthController.php',
    'dashboard' => 'DashboardController.php',
    'projects' => 'ProjectController.php',
    'tasks' => 'TaskController.php',
    'documents' => 'DocumentController.php',
    'reports' => 'ReportController.php'
];

if (array_key_exists($controller_name, $controllers_map)) {
    require_once "controllers/" . $controllers_map[$controller_name];
    $class_name = ucfirst($controller_name) . "Controller";
    
    // Simple basic dependency resolution or static call can go here,
    // but for vanilla PHP we'll instantiate and call the method.
    if (class_exists($class_name)) {
        $controller = new $class_name();
        if (method_exists($controller, $action_name)) {
            // Pass any extra parts as arguments (e.g. id)
            $args = array_slice($url_parts, 2);
            call_user_func_array([$controller, $action_name], $args);
        } else {
            http_response_code(404);
            echo "404 - Action Not Found";
        }
    } else {
        http_response_code(404);
        echo "404 - Controller Class Not Found";
    }
} else {
    http_response_code(404);
    echo "404 - Page Not Found";
}
