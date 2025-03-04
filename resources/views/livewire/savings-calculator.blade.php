<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Savings Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateSavings">
                <!-- Initial Savings -->
                <div class="mb-3">
                    <label for="initialSavings" class="form-label">Initial Savings</label>
                    <input type="number" class="form-control" id="initialSavings" wire:model="initialSavings" placeholder="Enter initial savings" required>
                </div>

                <!-- Monthly Contribution -->
                <div class="mb-3">
                    <label for="monthlyContribution" class="form-label">Monthly Contribution</label>
                    <input type="number" class="form-control" id="monthlyContribution" wire:model="monthlyContribution" placeholder="Enter monthly contribution" required>
                </div>

                <!-- Interest Rate -->
                <div class="mb-3">
                    <label for="interestRate" class="form-label">Annual Interest Rate (%)</label>
                    <input type="number" class="form-control" id="interestRate" wire:model="interestRate" step="0.01" placeholder="Enter annual interest rate" required>
                </div>

                <!-- Savings Duration -->
                <div class="mb-3">
                    <label for="savingsDuration" class="form-label">Savings Duration (Years)</label>
                    <input type="number" class="form-control" id="savingsDuration" wire:model="savingsDuration" placeholder="Enter duration in years" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate Savings</button>
            </form>

            <!-- Results -->
            @if($totalSavings)
                <div class="mt-4 alert alert-success">
                    <p><strong>Total Savings:</strong> ${{ number_format($totalSavings, 2) }}</p>
                    <p><strong>Interest Earned:</strong> ${{ number_format($interestEarned, 2) }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
