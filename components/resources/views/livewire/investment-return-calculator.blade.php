<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Investment Return Calculator</h4>
        </div>
        <div class="card-body">
            <!-- Investment Input Form -->
            <form wire:submit.prevent="calculateInvestmentReturn">
                <!-- Initial Investment -->
                <div class="mb-3">
                    <label for="initialInvestment" class="form-label">Initial Investment ($)</label>
                    <input type="number" class="form-control" id="initialInvestment" wire:model="initialInvestment" placeholder="Enter initial investment" required>
                </div>

                <!-- Annual Return Rate -->
                <div class="mb-3">
                    <label for="annualReturnRate" class="form-label">Annual Return Rate (%)</label>
                    <input type="number" class="form-control" id="annualReturnRate" wire:model="annualReturnRate" placeholder="Enter annual return rate" required>
                </div>

                <!-- Investment Duration -->
                <div class="mb-3">
                    <label for="investmentDuration" class="form-label">Investment Duration (Years)</label>
                    <input type="number" class="form-control" id="investmentDuration" wire:model="investmentDuration" placeholder="Enter investment duration in years" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate Returns</button>
            </form>

            <!-- Results -->
            @if ($finalValue > 0)
                <div class="alert alert-success mt-4">
                    <strong>Final Investment Value:</strong> ${{ number_format($finalValue, 2) }}
                </div>
            @endif
        </div>
    </div>
</div>
