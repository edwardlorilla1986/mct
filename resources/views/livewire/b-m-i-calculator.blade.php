<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>BMI Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateBMI">
                <!-- Height Input -->
                <div class="mb-3">
                    <label for="height" class="form-label">Height (cm)</label>
                    <input type="number" class="form-control" id="height" wire:model="height" placeholder="Enter your height in cm" required>
                </div>

                <!-- Weight Input -->
                <div class="mb-3">
                    <label for="weight" class="form-label">Weight (kg)</label>
                    <input type="number" class="form-control" id="weight" wire:model="weight" placeholder="Enter your weight in kg" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate BMI</button>
            </form>

            <!-- Results -->
            @if ($bmi > 0)
                <div class="alert alert-success mt-4">
                    <h5>Results:</h5>
                    <p><strong>BMI:</strong> {{ number_format($bmi, 2) }}</p>
                    <p><strong>Classification:</strong> {{ $classification }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
