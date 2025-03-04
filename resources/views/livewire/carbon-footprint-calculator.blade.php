<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Carbon Footprint Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateCarbonFootprint">
                <!-- Energy Consumption -->
                <div class="mb-3">
                    <label for="energyConsumption" class="form-label">Energy Consumption (kWh)</label>
                    <input type="number" step="0.01" class="form-control" id="energyConsumption" wire:model="energyConsumption" placeholder="Enter your monthly energy consumption in kWh" required>
                </div>

                <!-- Travel Distance -->
                <div class="mb-3">
                    <label for="travelDistance" class="form-label">Travel Distance (km)</label>
                    <input type="number" step="0.01" class="form-control" id="travelDistance" wire:model="travelDistance" placeholder="Enter your monthly travel distance in km" required>
                </div>

                <!-- Diet Type -->
                <div class="mb-3">
                    <label for="dietType" class="form-label">Diet Type</label>
                    <select class="form-select" id="dietType" wire:model="dietType">
                        <option value="">Select your diet type</option>
                        <option value="vegetarian">Vegetarian</option>
                        <option value="vegan">Vegan</option>
                        <option value="meat">Meat-Based</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate Carbon Footprint</button>
            </form>

            <!-- Results -->
            @if ($carbonEmissions > 0)
                <div class="alert alert-success mt-4">
                    <h5>Results:</h5>
                    <p><strong>Total Carbon Emissions:</strong> {{ number_format($carbonEmissions, 2) }} tons CO2</p>
                </div>
            @endif
        </div>
    </div>
</div>
