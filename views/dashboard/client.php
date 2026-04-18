<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold mb-2">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
    <p class="text-slate-400">Track the progress of your projects here.</p>
</div>

<div class="glass-card rounded-xl p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Your Projects</h2>
        <a href="/projects" class="text-sm text-cyan-400 hover:text-cyan-300">View All &rarr;</a>
    </div>
    
    <!-- Empty state for template -->
    <div class="text-center py-10 bg-slate-800/30 rounded-lg border border-slate-700">
        <svg class="w-12 h-12 text-slate-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        <p class="text-slate-400">Navigate to projects to see real-time updates.</p>
    </div>
</div>

        </div>
    </main>
</body>
</html>
