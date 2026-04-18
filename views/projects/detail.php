<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="mb-6 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <a href="/projects" class="text-slate-400 hover:text-cyan-400 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-3xl font-bold"><?= htmlspecialchars($project['title']) ?></h1>
        <span class="px-3 py-1 rounded-full text-xs font-medium border bg-cyan-500/20 text-cyan-400 border-cyan-500/30 uppercase tracking-wider">
            <?= $project['status'] ?>
        </span>
    </div>
    <?php if (in_array($_SESSION['user_role'], ['pm', 'client', 'super_admin'])): ?>
    <a href="/reports/project/<?= $project['id'] ?>" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg transition-colors border border-slate-600 text-sm font-medium flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        View Report
    </a>
    <?php endif; ?>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
    <div class="lg:col-span-3">
        <!-- Overview Card -->
        <div class="glass-card rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold mb-3">Project Description</h3>
            <p class="text-slate-300 whitespace-pre-line"><?= htmlspecialchars($project['description'] ?: 'No description.') ?></p>
        </div>

        <?php if (in_array($_SESSION['user_role'], ['pm', 'programmer', 'super_admin'])): ?>
            <!-- Kanban Board Container -->
            <?php include __DIR__ . '/../kanban/board.php'; ?>
        <?php endif; ?>
    </div>

    <!-- Sidebar Info -->
    <div class="space-y-6">
        <div class="glass-card rounded-xl p-6">
            <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-4">Project Details</h3>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-slate-500 mb-1">Client</p>
                    <p class="font-medium"><?= htmlspecialchars($project['client_name']) ?></p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 mb-1">Project Manager</p>
                    <p class="font-medium"><?= htmlspecialchars($project['pm_name']) ?></p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 mb-1">Deadline</p>
                    <p class="font-medium text-rose-400"><?= date('F j, Y', strtotime($project['deadline'])) ?></p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 mb-1">Progress</p>
                    <div class="flex items-center gap-3">
                        <div class="flex-1 bg-slate-700/50 rounded-full h-2">
                            <div class="bg-gradient-to-r from-cyan-400 to-emerald-400 h-2 rounded-full" id="project-progress-bar" style="width: <?= $project['progress'] ?>%"></div>
                        </div>
                        <span class="font-medium text-cyan-400" id="project-progress-text"><?= $project['progress'] ?>%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Section -->
        <div class="glass-card rounded-xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Documents</h3>
            </div>
            
            <?php if (in_array($_SESSION['user_role'], ['pm', 'programmer', 'super_admin'])): ?>
                <form action="/documents/upload" method="POST" enctype="multipart/form-data" class="mb-4">
                    <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
                    <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                    <div class="flex items-center gap-2">
                        <input type="file" name="file" required class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                        <button type="submit" class="p-2 bg-cyan-500 hover:bg-cyan-400 text-white rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </button>
                    </div>
                </form>
            <?php endif; ?>

            <div class="space-y-2 max-h-60 overflow-y-auto docs-list pr-2">
                <?php if (empty($documents)): ?>
                    <p class="text-sm text-slate-500 text-center py-2">No documents attached.</p>
                <?php else: ?>
                    <?php foreach ($documents as $doc): ?>
                        <a href="/documents/download/<?= $doc['id'] ?>" class="flex items-center justify-between p-3 rounded-lg bg-slate-800/50 hover:bg-slate-700/50 transition-colors group">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <span class="text-sm text-slate-200 truncate group-hover:text-cyan-400 transition-colors"><?= htmlspecialchars($doc['file_name']) ?></span>
                            </div>
                            <svg class="w-4 h-4 text-slate-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Make CSRF token available globally for JS fetches
    window.csrf_token = "<?= generate_csrf_token() ?>";
</script>
<script src="/assets/js/kanban.js?v=<?= time() ?>"></script>

        </div>
    </main>
</body>
</html>
