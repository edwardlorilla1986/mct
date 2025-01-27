<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Fuel Cost Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateFuelCost">
                <!-- Distance -->
                <div class="mb-3">
                    <label for="distance" class="form-label">Distance (miles or km)</label>
                    <input type="number" class="form-control" id="distance" wire:model="distance" placeholder="Enter distance of the trip" required>
                </div>

                <!-- Fuel Efficiency -->
                <div class="mb-3">
                    <label for="fuelEfficiency" class="form-label">Fuel Efficiency (MPG or L/100km)</label>
                    <input type="number" step="0.01" class="form-control" id="fuelEfficiency" wire:model="fuelEfficiency" placeholder="Enter your vehicle's fuel efficiency" required>
                </div>

                <!-- Fuel Price -->
                <div class="mb-3">
                    <label for="fuelPrice" class="form-label">Fuel Price ($ per gallon or liter)</label>
                    <input type="number" step="0.01" class="form-control" id="fuelPrice" wire:model="fuelPrice" placeholder="Enter the fuel price" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate</button>
            </form>

            <!-- Results -->
            @if ($totalFuelCost > 0)
                <div class="alert alert-success mt-4">
                    <h5>Results:</h5>
                    <p><strong>Total Fuel Cost:</strong> ${{ number_format($totalFuelCost, 2) }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
