<?php
// Extracted Kanban board component to be included in detail.php
$col_todo = array_filter($tasks, fn($t) => $t['status'] === 'todo');
$col_ip = array_filter($tasks, fn($t) => $t['status'] === 'in_progress');
$col_done = array_filter($tasks, fn($t) => $t['status'] === 'done');

function render_task_card($task) {
    $priority_colors = [
        'low' => 'bg-slate-500/20 text-slate-400',
        'medium' => 'bg-yellow-500/20 text-yellow-400',
        'high' => 'bg-rose-500/20 text-rose-400'
    ];
    $pcolor = $priority_colors[$task['priority']] ?? $priority_colors['medium'];
    
    echo '<div class="task-card bg-slate-800 p-4 rounded-lg shadow-sm border border-slate-700/50 cursor-grab active:cursor-grabbing hover:border-cyan-500/30 transition-colors" draggable="true" data-id="'.$task['id'].'">';
    echo '<div class="flex justify-between items-start mb-2">';
    echo '<span class="text-xs font-semibold px-2 py-0.5 rounded uppercase '.$pcolor.'">'.$task['priority'].'</span>';
    echo '</div>';
    echo '<h4 class="font-medium text-slate-200 text-sm mb-2">'.htmlspecialchars($task['title']).'</h4>';
    if ($task['due_date']) {
        echo '<div class="flex items-center text-xs text-slate-500 mb-3"><svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>'.date('M d', strtotime($task['due_date'])).'</div>';
    }
    echo '<div class="flex justify-between items-center mt-3 pt-3 border-t border-slate-700/50">';
    echo '<div class="flex items-center gap-2">';
    echo '<div class="w-6 h-6 rounded-full bg-cyan-900 flex items-center justify-center text-[10px] font-bold text-cyan-400" title="'.htmlspecialchars($task['programmer_name']).'">'.substr($task['programmer_name'], 0, 1).'</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>

<div class="mb-4 flex justify-between items-center">
    <h3 class="text-xl font-bold">Task Board</h3>
    <?php if (in_array($_SESSION['user_role'], ['pm', 'super_admin'])): ?>
        <button onclick="document.getElementById('newTaskModal').classList.remove('hidden')" class="px-3 py-1.5 bg-white/10 hover:bg-white/20 text-sm font-medium rounded-lg transition-colors border border-white/5">
            + Add Task
        </button>
    <?php endif; ?>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- TODO Column -->
    <div class="glass-card rounded-xl bg-slate-900/50 flex flex-col h-[600px]">
        <div class="p-4 border-b border-slate-700/50 flex justify-between items-center">
            <h4 class="font-semibold flex items-center gap-2 text-slate-300">
                <div class="w-2.5 h-2.5 rounded-full bg-slate-500"></div> To Do
            </h4>
            <span class="text-xs bg-slate-800 text-slate-400 px-2 py-1 rounded-full"><?= count($col_todo) ?></span>
        </div>
        <div class="p-4 flex-1 overflow-y-auto kanban-col space-y-3" data-status="todo" id="col-todo">
            <?php foreach($col_todo as $task) render_task_card($task); ?>
        </div>
    </div>

    <!-- IN PROGRESS Column -->
    <div class="glass-card rounded-xl bg-slate-900/50 flex flex-col h-[600px]">
        <div class="p-4 border-b border-slate-700/50 flex justify-between items-center">
            <h4 class="font-semibold flex items-center gap-2 text-yellow-400">
                <div class="w-2.5 h-2.5 rounded-full bg-yellow-400 shadow-[0_0_8px_rgba(250,204,21,0.5)]"></div> In Progress
            </h4>
            <span class="text-xs bg-slate-800 text-slate-400 px-2 py-1 rounded-full"><?= count($col_ip) ?></span>
        </div>
        <div class="p-4 flex-1 overflow-y-auto kanban-col space-y-3" data-status="in_progress" id="col-ip">
            <?php foreach($col_ip as $task) render_task_card($task); ?>
        </div>
    </div>

    <!-- DONE Column -->
    <div class="glass-card rounded-xl bg-slate-900/50 flex flex-col h-[600px]">
        <div class="p-4 border-b border-slate-700/50 flex justify-between items-center">
            <h4 class="font-semibold flex items-center gap-2 text-emerald-400">
                <div class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.5)]"></div> Done
            </h4>
            <span class="text-xs bg-slate-800 text-slate-400 px-2 py-1 rounded-full"><?= count($col_done) ?></span>
        </div>
        <div class="p-4 flex-1 overflow-y-auto kanban-col space-y-3" data-status="done" id="col-done">
            <?php foreach($col_done as $task) render_task_card($task); ?>
        </div>
    </div>
</div>

<!-- Add Task Modal -->
<?php if (in_array($_SESSION['user_role'], ['pm', 'super_admin'])): ?>
<div id="newTaskModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="document.getElementById('newTaskModal').classList.add('hidden')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-slate-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-700">
            <div class="px-6 py-4 border-b border-slate-800">
                <h3 class="text-lg font-medium leading-6 text-slate-100" id="modal-title">Add New Task</h3>
            </div>
            <form action="/tasks/create" method="POST">
                <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
                <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Task Title</label>
                        <input type="text" name="title" required class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg focus:ring-2 focus:ring-cyan-500 text-slate-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Description</label>
                        <textarea name="description" rows="3" class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg focus:ring-2 focus:ring-cyan-500 text-slate-100 outline-none"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Assign To</label>
                            <select name="programmer_id" required class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-100 outline-none appearance-none">
                                <?php foreach ($programmers as $prog): ?>
                                    <option value="<?= $prog['id'] ?>"><?= htmlspecialchars($prog['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Priority</label>
                            <select name="priority" class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-100 outline-none appearance-none">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-slate-800/50 flex justify-end gap-3 rounded-b-2xl">
                    <button type="button" onclick="document.getElementById('newTaskModal').classList.add('hidden')" class="px-4 py-2 bg-transparent text-slate-300 hover:text-white rounded-lg transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-cyan-500 hover:bg-cyan-400 text-white rounded-lg transition-colors shadow-[0_0_10px_rgba(34,211,238,0.3)]">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
