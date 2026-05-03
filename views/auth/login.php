<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - VibeFlow</title>
    <link rel="icon" type="image/svg+xml" href="/assets/VibeFlow.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at center, #1e293b, #0f172a);
        }
        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .input-focus:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 1px #3b82f6;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="text-slate-100 min-h-screen flex items-center justify-center overflow-x-hidden">
    <!-- Background Decor -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-600/10 rounded-full filter blur-[100px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-cyan-600/10 rounded-full filter blur-[100px]"></div>
    </div>

    <div class="container mx-auto flex flex-col lg:flex-row items-center justify-center z-10 p-4 lg:p-0">
        <!-- Brand Section (Hidden on mobile) -->
        <div class="hidden lg:flex w-full lg:w-1/2 flex-col justify-center lg:pr-12 mb-12 lg:mb-0">
            <div class="flex items-center gap-6 mb-10">
                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center shadow-[0_0_50px_rgba(37,99,235,0.3)] floating">
                    <img src="/assets/VibeFlow.svg" class="w-20 h-20 brightness-0 invert" alt="VibeFlow Logo">
                </div>
                <div>
                    <h1 class="text-6xl font-extrabold tracking-tighter text-white">VIBEFLOW</h1>
                    <h2 class="text-2xl font-medium text-blue-400">Project Management System</h2>
                </div>
            </div>
            
            <div class="space-y-8 max-w-xl">
                <h3 class="text-4xl font-bold text-white leading-tight">Sistem Manajemen Proyek IT Berbasis Web</h3>
                <p class="text-slate-400 text-xl leading-relaxed">
                    VibeFlow - Sistem Manajemen Proyek IT Berbasis Web - Project Pract Web.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="mt-1 bg-blue-500/20 p-2 rounded-lg text-blue-400">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                        </div>
                        <p class="text-slate-300 text-lg">Pantau alur kerja proyek dengan papan Kanban interaktif secara real-time.</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="mt-1 bg-cyan-500/20 p-2 rounded-lg text-cyan-400">
                            <i data-lucide="users" class="w-5 h-5"></i>
                        </div>
                        <p class="text-slate-300 text-lg">Kelola kolaborasi tim dan tugas dengan lebih efisien dan terorganisir.</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="mt-1 bg-purple-500/20 p-2 rounded-lg text-purple-400">
                            <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                        </div>
                        <p class="text-slate-300 text-lg">Analisis status proyek dan performa tim melalui laporan terpadu.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Form Card -->
        <div class="w-full max-w-[480px] lg:w-1/2">
            <div class="glass-card p-8 lg:p-12 rounded-[2rem] shadow-2xl relative overflow-hidden border border-white/10">
                <!-- Inner Glow -->
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl"></div>
                
                <div class="flex flex-col items-center mb-10 relative z-10">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center shadow-lg mb-6 ring-4 ring-white/5">
                        <img src="/assets/VibeFlow.svg" class="w-12 h-12 brightness-0 invert" alt="VibeFlow Logo">
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Selamat datang</h2>
                    <p class="text-slate-400">Masuk ke akun VibeFlow Anda</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-sm flex items-center gap-3 animate-shake">
                        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>
                <?php endif; ?>

                <form action="/auth/login" method="POST" class="space-y-6 relative z-10">
                    <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
                    
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-semibold text-slate-300 ml-1 flex items-center gap-2">
                            <span class="text-rose-500">*</span> Username atau Email
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-400 transition-colors">
                                <i data-lucide="user" class="w-5 h-5"></i>
                            </div>
                            <input type="email" id="email" name="email" required 
                                class="w-full pl-12 pr-4 py-4 bg-slate-900/60 border border-slate-700 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-white placeholder-slate-600 transition-all" 
                                placeholder="Masukkan username atau email">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="text-sm font-semibold text-slate-300 ml-1 flex items-center gap-2">
                            <span class="text-rose-500">*</span> Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-400 transition-colors">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <input type="password" id="password" name="password" required 
                                class="w-full pl-12 pr-12 py-4 bg-slate-900/60 border border-slate-700 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-white placeholder-slate-600 transition-all" 
                                placeholder="Masukkan password">
                            <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-white transition-colors">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between py-2">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="remember" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-slate-700 bg-slate-900 transition-all checked:border-blue-500 checked:bg-blue-500" />
                                <i data-lucide="check" class="absolute w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity"></i>
                            </div>
                            <span class="text-sm text-slate-400 group-hover:text-slate-300 transition-colors">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm font-medium text-blue-400 hover:text-blue-300 transition-colors">Lupa password?</a>
                    </div>

                    <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-900/20 transform active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                        <span>Masuk</span>
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-white/5 text-center">
                    <p class="text-slate-500 text-xs mb-3 uppercase tracking-widest font-semibold">Akun Demo</p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="px-2 py-1 bg-slate-800/50 rounded text-[10px] text-slate-400 border border-slate-700">admin@</span>
                        <span class="px-2 py-1 bg-slate-800/50 rounded text-[10px] text-slate-400 border border-slate-700">pm@</span>
                        <span class="px-2 py-1 bg-slate-800/50 rounded text-[10px] text-slate-400 border border-slate-700">dev@</span>
                        <span class="px-2 py-1 bg-slate-800/50 rounded text-[10px] text-slate-400 border border-slate-700">client@</span>
                    </div>
                </div>
            </div>
            
            <p class="mt-8 text-center text-slate-500 text-sm">
                &copy; 2026 VibeFlow. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
        
        // Password Toggle Functionality
        const toggleBtn = document.querySelector('button[type="button"]');
        const passwordInput = document.getElementById('password');
        const eyeIcon = toggleBtn.querySelector('i');

        toggleBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        });
    </script>
</body>
</html>
