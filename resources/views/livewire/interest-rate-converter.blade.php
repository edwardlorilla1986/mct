<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded">
        <h1 class="text-center mb-4">Interest Rate Converter</h1>

        <!-- Annual Interest Rate Input -->
        <div class="mb-3">
            <label for="rate" class="form-label">
                Annual Interest Rate (%) 
                <small class="text-muted">(e.g., 12.5 for 12.5%)</small>
            </label>
            <input
                type="number"
                id="rate"
                wire:model="rate"
                class="form-control"
                placeholder="Enter annual rate"
                aria-describedby="rateHelp"
            >
            <div id="rateHelp" class="form-text">Input the annual interest rate to convert.</div>
        </div>

        <!-- Conversion Frequency Dropdown -->
        <div class="mb-3">
            <label for="frequency" class="form-label">Conversion Frequency</label>
            <select
                id="frequency"
                wire:model="frequency"
                class="form-select"
            >
                <option value="monthly">Monthly</option>
                <option value="weekly">Weekly</option>
                <option value="daily">Daily</option>
            </select>
        </div>

        <!-- Convert Button -->
        <div class="text-center">
            <button
                wire:click="convertRate"
                class="btn btn-primary btn-lg"
            >
                Convert
            </button>
        </div>

        <!-- Converted Rate Output -->
        @if($convertedRate)
            <div class="alert alert-success text-center mt-4" role="alert">
                <strong>Converted Rate:</strong> {{ $convertedRate }}
            </div>
        @else
            @if(isset($rate) && !$rate)
                <div class="alert alert-danger text-center mt-4" role="alert">
                    <strong>Error:</strong> Please enter a valid annual interest rate.
                </div>
            @endif
        @endif
    </div>
</div>
