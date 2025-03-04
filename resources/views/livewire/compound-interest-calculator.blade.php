<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Compound Interest Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateCompoundInterest">
                <!-- Principal Amount -->
                <div class="mb-3">
                    <label for="principal" class="form-label">Principal Amount ($)</label>
                    <input type="number" class="form-control" id="principal" wire:model="principal" placeholder="Enter principal amount" required>
                </div>

                <!-- Interest Rate -->
                <div class="mb-3">
                    <label for="rate" class="form-label">Annual Interest Rate (%)</label>
                    <input type="number" class="form-control" id="rate" wire:model="rate" placeholder="Enter annual interest rate" required>
                </div>

                <!-- Compounding Frequency -->
                <div class="mb-3">
                    <label for="frequency" class="form-label">Compounding Frequency</label>
                    <select class="form-select" id="frequency" wire:model="frequency">
                        <option value="1">Annually</option>
                        <option value="4">Quarterly</option>
                        <option value="12">Monthly</option>
                        <option value="365">Daily</option>
                    </select>
                </div>

                <!-- Time Period -->
                <div class="mb-3">
                    <label for="time" class="form-label">Time Period (Years)</label>
                    <input type="number" class="form-control" id="time" wire:model="time" placeholder="Enter time period in years" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate</button>
            </form>

            <!-- Results -->
            @if ($totalAmount > 0)
                <div class="alert alert-success mt-4">
                    <h5>Results:</h5>
                    <p><strong>Total Amount:</strong> ${{ number_format($totalAmount, 2) }}</p>
                    <p><strong>Interest Earned:</strong> ${{ number_format($interestEarned, 2) }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
