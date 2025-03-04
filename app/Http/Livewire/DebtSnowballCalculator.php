<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DebtSnowballCalculator extends Component
{
    public $debts = [];
    public $newDebt = [
        'name' => '',
        'balance' => 0,
        'interestRate' => 0,
        'minPayment' => 0,
    ];
    public $extraPayment = 0;
    public $paymentPlan = [];

    protected $rules = [
        'newDebt.name' => 'required|string|max:255',
        'newDebt.balance' => 'required|numeric|min:0',
        'newDebt.interestRate' => 'required|numeric|min:0',
        'newDebt.minPayment' => 'required|numeric|min:0',
        'extraPayment' => 'nullable|numeric|min:0',
    ];

    public function addDebt()
    {
        $this->validate([
            'newDebt.name' => 'required|string|max:255',
            'newDebt.balance' => 'required|numeric|min:0',
            'newDebt.interestRate' => 'required|numeric|min:0',
            'newDebt.minPayment' => 'required|numeric|min:0',
        ]);

        $this->debts[] = [
            'name' => $this->newDebt['name'],
            'balance' => $this->newDebt['balance'],
            'interestRate' => $this->newDebt['interestRate'],
            'minPayment' => $this->newDebt['minPayment'],
        ];

        $this->reset('newDebt');
    }

    public function calculatePlan()
    {
        $this->validate(['extraPayment' => 'nullable|numeric|min:0']);

        // Sort debts by balance (smallest to largest)
        $sortedDebts = collect($this->debts)->sortBy('balance')->toArray();

        $this->paymentPlan = [];
        $remainingExtraPayment = $this->extraPayment;

        while (!empty($sortedDebts)) {
            $currentDebt = array_shift($sortedDebts);
            $month = 1;
            $debtPlan = [
                'name' => $currentDebt['name'],
                'payments' => []
            ];

            while ($currentDebt['balance'] > 0) {
                $payment = $currentDebt['minPayment'] + $remainingExtraPayment;
                if ($payment > $currentDebt['balance']) {
                    $payment = $currentDebt['balance'];
                }

                $currentDebt['balance'] -= $payment;
                $remainingExtraPayment = max(0, $remainingExtraPayment - ($payment - $currentDebt['minPayment']));

                $debtPlan['payments'][] = [
                    'month' => $month,
                    'payment' => $payment,
                    'remainingBalance' => max(0, $currentDebt['balance']),
                ];
                $month++;
            }

            $this->paymentPlan[] = $debtPlan;
        }
    }

    public function render()
    {
        return view('livewire.debt-snowball-calculator');
    }
}

?>