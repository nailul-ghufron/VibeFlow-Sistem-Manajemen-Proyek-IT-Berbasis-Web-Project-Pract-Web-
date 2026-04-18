<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VibeFlow Login</title>
    <link rel="icon" type="image/svg+xml" href="/assets/VibeFlow.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0f172a] text-slate-100 flex items-center justify-center min-h-screen relative overflow-hidden">
    <!-- Abstract Background Decor -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute top-[20%] right-[-10%] w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

    <div class="w-full max-w-md p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl relative z-10">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold tracking-tight mb-2 text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-[0_0_10px_rgba(34,211,238,0.5)]">VibeFlow</h1>
            <p class="text-slate-400">Sign in to your account</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="mb-4 p-3 rounded bg-rose-500/20 border border-rose-500/50 text-rose-300 text-sm">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/auth/login" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
            
            <div>
                <label for="email" class="block text-sm font-medium text-slate-300 mb-1">Email Address</label>
                <input type="email" id="email" name="email" required class="w-full px-4 py-2.5 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-slate-100 placeholder-slate-500 transition-all outline-none" placeholder="you@example.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-300 mb-1">Password</label>
                <input type="password" id="password" name="password" required class="w-full px-4 py-2.5 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-slate-100 placeholder-slate-500 transition-all outline-none" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full py-2.5 px-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-semibold rounded-lg shadow-[0_0_15px_rgba(34,211,238,0.4)] transition-all transform hover:scale-[1.02]">
                Sign In
            </button>
        </form>
        
        <div class="mt-6 text-center text-xs text-slate-500">
            <p>Demo Accounts: admin@, pm@, dev@, client@ (pw: password123)</p>
        </div>
    </div>
</body>
</html>
