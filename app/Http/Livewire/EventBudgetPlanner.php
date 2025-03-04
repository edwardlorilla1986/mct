<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EventBudgetPlanner extends Component
{
    public $eventName;
    public $eventDate;
    public $categories = [];
    public $newCategory = [
        'name' => '',
        'budget' => 0,
    ];
    public $totalBudget = 0;
    public $expenses = [];

    protected $rules = [
        'eventName' => 'required|string|max:255',
        'eventDate' => 'required|date|after:now',
        'newCategory.name' => 'required|string|max:255',
        'newCategory.budget' => 'required|numeric|min:0',
    ];

    public function addCategory()
    {
        $this->validate([
            'newCategory.name' => 'required|string|max:255',
            'newCategory.budget' => 'required|numeric|min:0',
        ]);

        $this->categories[] = [
            'name' => $this->newCategory['name'],
            'budget' => $this->newCategory['budget'],
            'expenses' => [],
        ];

        $this->totalBudget += $this->newCategory['budget'];
        $this->reset('newCategory');
    }

    public function addExpense($categoryIndex, $expenseName, $expenseAmount)
    {
        if (!isset($this->categories[$categoryIndex])) {
            return;
        }

        $this->validate([
            'expenseName' => 'required|string|max:255',
            'expenseAmount' => 'required|numeric|min:0',
        ]);

        $this->categories[$categoryIndex]['expenses'][] = [
            'name' => $expenseName,
            'amount' => $expenseAmount,
        ];
    }

    public function calculateTotalExpenses()
    {
        $this->expenses = collect($this->categories)->flatMap(function ($category) {
            return $category['expenses'];
        });

        $this->totalExpenses = $this->expenses->sum('amount');
    }

    public function render()
    {
        return view('livewire.event-budget-planner');
    }
}

?>