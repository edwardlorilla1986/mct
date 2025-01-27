<?php
namespace App\Http\Livewire;

use Livewire\Component;

class TaskPrioritizationMatrix extends Component
{
    public $quadrants = [
        'important_urgent' => [],
        'important_not_urgent' => [],
        'not_important_urgent' => [],
        'not_important_not_urgent' => [],
    ];

    public $taskId = 1;
    public $newTaskName = [];
    public $editingTaskId = null;
    public $editingTaskName = '';

    // Add a new task with a custom name
    public function addTask($quadrant)
    {
        $taskName = $this->newTaskName[$quadrant] ?? "Task " . $this->taskId;
        $this->quadrants[$quadrant][] = [
            'id' => $this->taskId++,
            'name' => $taskName,
            'completed' => false,
        ];
        $this->newTaskName[$quadrant] = ''; // Clear input field
        $this->dispatchBrowserEvent('taskAdded', ['quadrant' => $quadrant]);
    }

    // Mark a task as complete
    public function markAsComplete($taskId)
    {
        foreach ($this->quadrants as $quadrant => &$tasks) {
            foreach ($tasks as &$task) {
                if ($task['id'] === $taskId) {
                    $task['completed'] = true;
                    $this->dispatchBrowserEvent('taskCompleted', ['taskId' => $taskId]);
                    return;
                }
            }
        }
    }

    // Enable task editing mode
    public function editTask($taskId, $taskName)
    {
        $this->editingTaskId = $taskId;
        $this->editingTaskName = $taskName;
    }

    // Update task name
    public function updateTaskName($taskId)
    {
        foreach ($this->quadrants as &$tasks) {
            foreach ($tasks as &$task) {
                if ($task['id'] === $taskId) {
                    $task['name'] = $this->editingTaskName;
                    $this->editingTaskId = null;
                    $this->editingTaskName = '';
                    $this->dispatchBrowserEvent('taskUpdated', ['taskId' => $taskId]);
                    return;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.task-prioritization-matrix');
    }
}
