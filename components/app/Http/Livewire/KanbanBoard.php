<?php

namespace App\Http\Livewire;

use Livewire\Component;

class KanbanBoard extends Component
{
    public $columns = [];
    public $newColumnName;
    public $newTask = [
        'name' => '',
        'description' => '',
        'columnIndex' => null,
    ];

    protected $rules = [
        'newColumnName' => 'required|string|max:255',
        'newTask.name' => 'required|string|max:255',
        'newTask.description' => 'nullable|string|max:500',
        'newTask.columnIndex' => 'required|integer',
    ];

    public function addColumn()
    {
        $this->validate(['newColumnName' => 'required|string|max:255']);

        $this->columns[] = [
            'name' => $this->newColumnName,
            'tasks' => [],
        ];

        $this->reset('newColumnName');
    }

    public function addTask()
    {
        $this->validate();

        $this->columns[$this->newTask['columnIndex']]['tasks'][] = [
            'name' => $this->newTask['name'],
            'description' => $this->newTask['description'],
        ];

        $this->reset('newTask');
    }

    public function moveTask($fromColumnIndex, $toColumnIndex, $taskIndex)
    {
        $task = $this->columns[$fromColumnIndex]['tasks'][$taskIndex];
        unset($this->columns[$fromColumnIndex]['tasks'][$taskIndex]);
        $this->columns[$fromColumnIndex]['tasks'] = array_values($this->columns[$fromColumnIndex]['tasks']);
        $this->columns[$toColumnIndex]['tasks'][] = $task;
    }

    public function render()
    {
        return view('livewire.kanban-board');
    }
}

?>