<div class="container my-5">
    <h1 class="h4 mb-4 text-center">Advanced Kanban Board</h1>

    <!-- Add Column -->
    <div class="mb-4">
        <h2 class="h5">Add Column</h2>
        <form id="addColumnForm" class="row g-3 align-items-center">
            <div class="col-md-9">
                <input type="text" id="newColumnName" placeholder="Column Name" class="form-control">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Add Column</button>
            </div>
        </form>
    </div>

    <!-- Kanban Columns -->
    <div id="kanbanBoard" class="row g-4">
        <!-- Columns will be dynamically injected here -->
    </div>

    <p id="emptyBoardMessage" class="text-muted mt-4 text-center">No columns added yet. Start creating your Kanban board!</p>
</div>

<script>
    let columns = JSON.parse(localStorage.getItem('kanbanColumns')) || [];

    // Render the Kanban board
    function renderBoard() {
        const board = document.getElementById('kanbanBoard');
        const emptyMessage = document.getElementById('emptyBoardMessage');
        board.innerHTML = '';

        if (columns.length === 0) {
            emptyMessage.style.display = 'block';
            return;
        } else {
            emptyMessage.style.display = 'none';
        }

        columns.forEach((column, columnIndex) => {
            const columnDiv = document.createElement('div');
            columnDiv.className = 'col-md-4';

            columnDiv.innerHTML = `
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">${column.name}</h5>
                        <button class="btn btn-danger btn-sm" onclick="deleteColumn(${columnIndex})">Delete</button>
                    </div>
                    <div class="card-body">
                        <div class="tasks">
                            ${column.tasks.map((task, taskIndex) => `
                                <div class="card mb-3">
                                    <div class="card-body p-2">
                                        <h6 class="mb-1">${task.name}</h6>
                                        <p class="mb-2 text-muted">${task.description || 'No description'}</p>
                                        <div class="d-flex justify-content-between">
                                            ${columnIndex > 0
                                                ? `<button class="btn btn-warning btn-sm" onclick="moveTask(${columnIndex}, ${columnIndex - 1}, ${taskIndex})">Left</button>`
                                                : ''}
                                            ${columnIndex < columns.length - 1
                                                ? `<button class="btn btn-success btn-sm" onclick="moveTask(${columnIndex}, ${columnIndex + 1}, ${taskIndex})">Right</button>`
                                                : ''}
                                            <button class="btn btn-danger btn-sm" onclick="deleteTask(${columnIndex}, ${taskIndex})">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                        <form class="mt-3" onsubmit="addTask(event, ${columnIndex})">
                            <input type="text" class="form-control mb-2" placeholder="Task Name" id="taskName${columnIndex}">
                            <input type="text" class="form-control mb-2" placeholder="Description (optional)" id="taskDescription${columnIndex}">
                            <button type="submit" class="btn btn-primary btn-sm w-100">Add Task</button>
                        </form>
                    </div>
                </div>
            `;

            board.appendChild(columnDiv);
        });
    }

    // Add a new column
    document.getElementById('addColumnForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const newColumnName = document.getElementById('newColumnName').value.trim();
        if (!newColumnName) {
            alert('Column name is required');
            return;
        }
        columns.push({ name: newColumnName, tasks: [] });
        document.getElementById('newColumnName').value = '';
        saveColumns();
        renderBoard();
    });

    // Add a task to a column
    function addTask(event, columnIndex) {
        event.preventDefault();
        const taskName = document.getElementById(`taskName${columnIndex}`).value.trim();
        const taskDescription = document.getElementById(`taskDescription${columnIndex}`).value.trim();

        if (!taskName) {
            alert('Task name is required');
            return;
        }

        columns[columnIndex].tasks.push({ name: taskName, description: taskDescription });
        saveColumns();
        renderBoard();
    }

    // Move a task between columns
    function moveTask(fromColumn, toColumn, taskIndex) {
        const task = columns[fromColumn].tasks.splice(taskIndex, 1)[0];
        columns[toColumn].tasks.push(task);
        saveColumns();
        renderBoard();
    }

    // Delete a column
    function deleteColumn(columnIndex) {
        if (confirm('Are you sure you want to delete this column?')) {
            columns.splice(columnIndex, 1);
            saveColumns();
            renderBoard();
        }
    }

    // Delete a task
    function deleteTask(columnIndex, taskIndex) {
        if (confirm('Are you sure you want to delete this task?')) {
            columns[columnIndex].tasks.splice(taskIndex, 1);
            saveColumns();
            renderBoard();
        }
    }

    // Save columns to localStorage
    function saveColumns() {
        localStorage.setItem('kanbanColumns', JSON.stringify(columns));
    }

    // Initialize the board on page load
    document.addEventListener('DOMContentLoaded', renderBoard);
</script>
