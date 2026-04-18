<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VibeFlow Dashboard</title>
    <link rel="icon" type="image/svg+xml" href="/assets/VibeFlow.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f1f5f9; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .glass-card:hover { border-color: rgba(34, 211, 238, 0.2); }
        /* Custom Scrollbar for Kanban */
        .kanban-col::-webkit-scrollbar { width: 6px; }
        .kanban-col::-webkit-scrollbar-track { background: rgba(0,0,0,0.1); border-radius: 4px; }
        .kanban-col::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
        .kanban-col::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
    </style>
</head>
<body class="flex min-h-screen relative">
    
    <?php include __DIR__ . '/sidebar.php'; ?>

    <main class="flex-1 ml-64 flex flex-col min-h-screen">
        <!-- Top Header -->
        <header class="h-16 glass-card sticky top-0 z-10 flex items-center justify-between px-8">
            <div class="flex items-center text-slate-400">
                <!-- Search could go here -->
                <span class="text-sm font-medium uppercase tracking-wider"><?= htmlspecialchars($_SESSION['user_role'] ?? 'User') ?> Portal</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-medium text-slate-200"><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></p>
                </div>
                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-cyan-500 to-blue-600 flex items-center justify-center font-bold shadow-[0_0_10px_rgba(34,211,238,0.3)]">
                    <?= substr($_SESSION['user_name'] ?? 'U', 0, 1) ?>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <div class="p-8 flex-1">
