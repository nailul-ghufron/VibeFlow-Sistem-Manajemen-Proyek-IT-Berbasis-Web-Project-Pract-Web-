<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold mb-2">Project Report</h1>
        <p class="text-slate-400"><?= htmlspecialchars($project['title']) ?></p>
    </div>
    <button onclick="window.print()" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-lg transition-colors border border-slate-600 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
        Print / Save PDF
    </button>
</div>

<div class="glass-card rounded-xl p-8 max-w-4xl mx-auto" id="printable-report">
    <div class="border-b border-slate-700 pb-6 mb-6 text-center">
        <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 inline-block mb-1">VibeFlow Project Report</h2>
        <p class="text-slate-400">Generated on <?= date('F j, Y') ?></p>
    </div>
    
    <div class="grid grid-cols-2 gap-8 mb-8">
        <div>
            <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Project Info</h3>
            <p><span class="text-slate-500">Title:</span> <span class="font-medium"><?= htmlspecialchars($project['title']) ?></span></p>
            <p><span class="text-slate-500">Status:</span> <span class="font-medium uppercase"><?= $project['status'] ?></span></p>
            <p><span class="text-slate-500">Deadline:</span> <span class="font-medium"><?= date('M d, Y', strtotime($project['deadline'])) ?></span></p>
            <p><span class="text-slate-500">Progress:</span> <span class="font-medium text-cyan-400"><?= $project['progress'] ?>%</span></p>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Stakeholders</h3>
            <p><span class="text-slate-500">Client:</span> <span class="font-medium"><?= htmlspecialchars($project['client_name']) ?></span></p>
            <p><span class="text-slate-500">Project Manager:</span> <span class="font-medium"><?= htmlspecialchars($project['pm_name']) ?></span></p>
        </div>
    </div>
    
    <!-- Add more report details here like tasks breakdown -->
</div>

<style>
    @media print {
        body * { visibility: hidden; }
        #printable-report, #printable-report * { visibility: visible; }
        #printable-report { position: absolute; left: 0; top: 0; width: 100%; background: white !important; color: black !important; }
        .glass-card { border: none; box-shadow: none; background: white !important; }
        .text-slate-400, .text-slate-500 { color: #4a5568 !important; }
        .text-cyan-400 { color: #0284c7 !important; }
        aside, header { display: none !important; }
        main { margin: 0 !important; padding: 0 !important; }
    }
</style>

        </div>
    </main>
</body>
</html>
