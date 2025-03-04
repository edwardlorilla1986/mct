<div class="container mt-5">
    <h3 class="text-center mb-4">Advanced Task Prioritization Matrix</h3>

    <!-- Eisenhower Matrix Grid -->
    <div class="row">
        @foreach ($quadrants as $quadrant => $tasks)
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg
                    {{ $quadrant === 'important_urgent' ? 'bg-danger text-white' : '' }}
                    {{ $quadrant === 'important_not_urgent' ? 'bg-success text-white' : '' }}
                    {{ $quadrant === 'not_important_urgent' ? 'bg-warning text-dark' : '' }}
                    {{ $quadrant === 'not_important_not_urgent' ? 'bg-secondary text-white' : '' }}">
                    <div class="card-header">
                        <strong>{{ ucwords(str_replace('_', ' & ', $quadrant)) }}</strong>
                        <small class="d-block">
                            {{ $quadrant === 'important_urgent' ? '(Do Now)' : '' }}
                            {{ $quadrant === 'important_not_urgent' ? '(Plan)' : '' }}
                            {{ $quadrant === 'not_important_urgent' ? '(Delegate)' : '' }}
                            {{ $quadrant === 'not_important_not_urgent' ? '(Eliminate)' : '' }}
                        </small>
                    </div>
                    <div class="card-body">
                        @foreach ($tasks as $task)
                            <div class="task-item d-flex justify-content-between align-items-center mb-2 p-2 rounded bg-light">
                                <div class="d-flex align-items-center">
                                    @if ($editingTaskId === $task['id'])
                                        <input type="text"
                                               class="form-control form-control-sm me-2"
                                               wire:model.defer="editingTaskName"
                                               wire:keydown.enter="updateTaskName({{ $task['id'] }})"
                                               placeholder="Edit task name"
                                               style="border: 1px solid #ced4da; border-radius: 4px; padding: 4px; color: #000; background-color: #fff;">
                                        <button class="btn btn-sm btn-success"
                                                wire:click="updateTaskName({{ $task['id'] }})">
                                            Save
                                        </button>
                                    @else
                                        <span class="{{ $task['completed'] ? 'text-decoration-line-through text-success' : 'text-dark' }}">
                                            {{ $task['name'] }}
                                        </span>
                                        <button class="btn btn-sm btn-link text-dark ms-2"
                                                wire:click="editTask({{ $task['id'] }}, '{{ $task['name'] }}')">
                                            Edit
                                        </button>
                                    @endif
                                </div>
                                @if ($task['completed'])
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <button class="btn btn-sm btn-primary" wire:click="markAsComplete({{ $task['id'] }})">
                                        Complete
                                    </button>
                                @endif
                            </div>
                        @endforeach
                        <div class="mt-3">
                            <!-- Input Field for Adding New Tasks -->
                            <input type="text"
                                   class="form-control form-control-sm mb-2"
                                   placeholder="Enter task name"
                                   wire:model.defer="newTaskName.{{ $quadrant }}"
                                   style="border: 1px solid #ced4da; border-radius: 4px; padding: 6px; color: #000; background-color: #fff;">
                            <button class="btn btn-light w-100" wire:click="addTask('{{ $quadrant }}')">
                                Add Task
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
