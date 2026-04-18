<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold mb-2">Welcome back, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
    <p class="text-slate-400">Here's an overview of your projects and tasks.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="glass-card rounded-xl p-6 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150"></div>
        <h3 class="text-slate-400 font-medium mb-1 relative z-10">Total Projects</h3>
        <p class="text-4xl font-bold text-slate-100 relative z-10">--</p>
    </div>
    <div class="glass-card rounded-xl p-6 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150"></div>
        <h3 class="text-slate-400 font-medium mb-1 relative z-10">Active Tasks</h3>
        <p class="text-4xl font-bold text-slate-100 relative z-10">--</p>
    </div>
    <div class="glass-card rounded-xl p-6 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150"></div>
        <h3 class="text-slate-400 font-medium mb-1 relative z-10">Upcoming Deadlines</h3>
        <p class="text-4xl font-bold text-slate-100 relative z-10">--</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Quick Actions -->
    <div class="glass-card rounded-xl p-6">
        <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            Quick Actions
        </h2>
        <div class="space-y-3">
            <a href="/projects/create" class="flex items-center gap-3 p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-colors border border-transparent hover:border-cyan-500/30">
                <div class="p-2 bg-cyan-500/20 text-cyan-400 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <div>
                    <h4 class="font-medium text-slate-200">Create New Project</h4>
                    <p class="text-sm text-slate-400">Start a new client project</p>
                </div>
            </a>
            <a href="/projects" class="flex items-center gap-3 p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-colors border border-transparent hover:border-purple-500/30">
                <div class="p-2 bg-purple-500/20 text-purple-400 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <div>
                    <h4 class="font-medium text-slate-200">View All Projects</h4>
                    <p class="text-sm text-slate-400">Monitor active progress</p>
                </div>
            </a>
        </div>
    </div>
</div>

        </div> <!-- End Main Content Area -->
    </main>
</body>
</html>
