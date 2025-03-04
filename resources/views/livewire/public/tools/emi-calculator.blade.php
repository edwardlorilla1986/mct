<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">EMI Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateEMI">
                <!-- Loan Amount -->
                <div class="mb-3">
                    <label for="principal" class="form-label">Loan Amount</label>
                    <input type="number" class="form-control" id="principal" wire:model="principal" placeholder="Enter loan amount" required>
                </div>

                <!-- Annual Interest Rate -->
                <div class="mb-3">
                    <label for="rate" class="form-label">Annual Interest Rate (%)</label>
                    <input type="number" class="form-control" id="rate" wire:model="rate" step="0.01" placeholder="Enter interest rate" required>
                </div>

                <!-- Loan Tenure -->
                <div class="mb-3">
                    <label for="tenure" class="form-label">Loan Tenure (Months)</label>
                    <input type="number" class="form-control" id="tenure" wire:model="tenure" placeholder="Enter loan tenure in months" required>
                </div>

                <!-- Currency Selector -->
                <div class="mb-3">
                    <label for="currency" class="form-label">Currency</label>
                    <select class="form-select" id="currency" wire:model="currency">
                        @foreach ($currencies as $currencyOption)
                            <option value="{{ $currencyOption }}">{{ $currencyOption }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate EMI</button>
            </form>

            <!-- EMI Result -->
            @if ($emi)
                <div class="mt-4 alert alert-success">
                    Your Monthly EMI in <strong>{{ $currency }}</strong> is: 
                    <strong>{{ number_format($emi, 2) }} {{ $currency }}</strong>
                </div>
            @endif
        </div>
    </div>
</div>
