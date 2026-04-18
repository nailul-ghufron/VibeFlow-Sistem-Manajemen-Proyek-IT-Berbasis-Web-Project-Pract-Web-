// assets/js/kanban.js

document.addEventListener('DOMContentLoaded', () => {
    const taskCards = document.querySelectorAll('.task-card');
    const kanbanCols = document.querySelectorAll('.kanban-col');

    let draggedItem = null;

    taskCards.forEach(card => {
        card.addEventListener('dragstart', function(e) {
            draggedItem = this;
            setTimeout(() => this.classList.add('opacity-50'), 0);
        });

        card.addEventListener('dragend', function(e) {
            setTimeout(() => this.classList.remove('opacity-50'), 0);
            draggedItem = null;
        });
    });

    kanbanCols.forEach(col => {
        col.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-cyan-500/50', 'border-dashed', 'border-2', 'bg-cyan-500/5');
        });

        col.addEventListener('dragleave', function(e) {
            this.classList.remove('border-cyan-500/50', 'border-dashed', 'border-2', 'bg-cyan-500/5');
        });

        col.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-cyan-500/50', 'border-dashed', 'border-2', 'bg-cyan-500/5');
            
            if (draggedItem) {
                this.appendChild(draggedItem);
                
                // Get the task ID and the new status
                const taskId = draggedItem.getAttribute('data-id');
                const newStatus = this.getAttribute('data-status');
                
                // Update the count badges
                updateCounts();
                
                // Send AJAX request to update status
                updateTaskStatus(taskId, newStatus);
            }
        });
    });

    function updateCounts() {
        kanbanCols.forEach(col => {
            const count = col.querySelectorAll('.task-card').length;
            col.previousElementSibling.querySelector('span').textContent = count;
        });
    }

    function updateTaskStatus(taskId, newStatus) {
        fetch('/tasks/update_status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                task_id: taskId,
                new_status: newStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update progress bar if it exists
                const progressBar = document.getElementById('project-progress-bar');
                const progressText = document.getElementById('project-progress-text');
                if (progressBar && progressText) {
                    progressBar.style.width = data.progress + '%';
                    progressText.textContent = data.progress + '%';
                }
            } else {
                console.error('Failed to update task status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
