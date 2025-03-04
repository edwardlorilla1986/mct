<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Retirement Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateRetirementSavings">
                <!-- Current Age -->
                <div class="mb-3">
                    <label for="currentAge" class="form-label">Current Age</label>
                    <input type="number" class="form-control" id="currentAge" wire:model="currentAge" placeholder="Enter your current age">
                </div>

                <!-- Retirement Age -->
                <div class="mb-3">
                    <label for="retirementAge" class="form-label">Retirement Age</label>
                    <input type="number" class="form-control" id="retirementAge" wire:model="retirementAge" placeholder="Enter your desired retirement age">
                </div>

                <!-- Monthly Expenses -->
                <div class="mb-3">
                    <label for="monthlyExpenses" class="form-label">Monthly Expenses ($)</label>
                    <input type="number" class="form-control" id="monthlyExpenses" wire:model="monthlyExpenses" placeholder="Enter estimated monthly expenses during retirement">
                </div>

                <!-- Inflation Rate -->
                <div class="mb-3">
                    <label for="inflationRate" class="form-label">Expected Inflation Rate (%)</label>
                    <input type="number" class="form-control" id="inflationRate" wire:model="inflationRate" step="0.1" placeholder="Enter annual inflation rate">
                </div>

                <!-- Current Savings -->
                <div class="mb-3">
                    <label for="savings" class="form-label">Current Savings ($)</label>
                    <input type="number" class="form-control" id="savings" wire:model="savings" placeholder="Enter your current savings">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate Retirement Savings</button>
            </form>

            <!-- Results -->
            @if ($totalRequiredSavings > 0)
                <div class="alert alert-success mt-4">
                    <p><strong>Total Required Savings:</strong> ${{ number_format($totalRequiredSavings, 2) }}</p>
                </div>
            @elseif ($totalRequiredSavings === 0)
                <div class="alert alert-success mt-4">
                    <p>Congratulations! You already have enough savings for retirement!</p>
                </div>
            @endif
        </div>
    </div>
</div>
