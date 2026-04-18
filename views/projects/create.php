<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="/projects" class="text-slate-400 hover:text-cyan-400 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-3xl font-bold">Create New Project</h1>
    </div>

    <div class="glass-card rounded-2xl p-8">
        <?php if (!empty($error)): ?>
            <div class="mb-6 p-4 rounded-lg bg-rose-500/20 border border-rose-500/50 text-rose-300">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/projects/create" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
            
            <div>
                <label for="title" class="block text-sm font-medium text-slate-300 mb-2">Project Title</label>
                <input type="text" id="title" name="title" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-slate-100 placeholder-slate-500 transition-all outline-none" placeholder="e.g., E-Commerce Redesign">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-slate-300 mb-2">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-slate-100 placeholder-slate-500 transition-all outline-none" placeholder="Brief project overview..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="client_id" class="block text-sm font-medium text-slate-300 mb-2">Assign Client</label>
                    <select id="client_id" name="client_id" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-slate-100 outline-none appearance-none">
                        <option value="">Select a client...</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= $client['id'] ?>"><?= htmlspecialchars($client['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="deadline" class="block text-sm font-medium text-slate-300 mb-2">Deadline</label>
                    <input type="date" id="deadline" name="deadline" required class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-slate-100 outline-none appearance-none">
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-4">
                <a href="/projects" class="px-6 py-3 rounded-lg border border-slate-600 text-slate-300 hover:bg-slate-800 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-semibold rounded-lg shadow-[0_0_15px_rgba(34,211,238,0.4)] transition-all">
                    Create Project
                </button>
            </div>
        </form>
    </div>
</div>

        </div>
    </main>
</body>
</html>
