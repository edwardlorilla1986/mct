<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExpenseTracker extends Component
{
    public $expenses = [];
    public $categories = ['Food', 'Rent', 'Entertainment', 'Transportation', 'Others'];
    public $newExpense = [
        'amount' => 0,
        'category' => '',
        'date' => '',
        'description' => ''
    ];
    public $budget = 1000; // Default monthly budget
    public $totalExpenses = 0;
    public $budgetAlert = false;

    public function addExpense()
    {
        // Validate input
        $this->validate([
            'newExpense.amount' => 'required|numeric|min:0.01',
            'newExpense.category' => 'required',
            'newExpense.date' => 'required|date',
            'newExpense.description' => 'nullable|string|max:255',
        ]);

        // Add the new expense
        $this->expenses[] = $this->newExpense;

        // Recalculate total expenses
        $this->calculateTotalExpenses();

        // Reset the input fields
        $this->newExpense = [
            'amount' => 0,
            'category' => '',
            'date' => '',
            'description' => ''
        ];
    }

    public function calculateTotalExpenses()
    {
        $this->totalExpenses = array_sum(array_column($this->expenses, 'amount'));

        // Check for budget alert
        $this->budgetAlert = $this->totalExpenses >= ($this->budget * 0.9);
    }

    public function render()
    {
        return view('livewire.expense-tracker');
    }
}
