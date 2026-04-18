<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold mb-2">Hello, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
    <p class="text-slate-400">Here are your active assignments.</p>
</div>

<div class="glass-card rounded-xl p-6">
    <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        My Active Projects
    </h2>
    <div class="space-y-4">
        <!-- Would normally loop through projects here -->
        <a href="/projects" class="block w-full text-center py-3 rounded-lg border border-dashed border-slate-600 text-slate-400 hover:text-cyan-400 hover:border-cyan-400/50 hover:bg-cyan-500/5 transition-all">
            Go to Projects List to see your tasks
        </a>
    </div>
</div>

        </div>
    </main>
</body>
</html>
