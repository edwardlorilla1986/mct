<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Workout Generator</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateWorkout">
                    <div class="mb-3">
                        <label for="goal" class="form-label">Fitness Goal</label>
                        <input type="text" id="goal" class="form-control" wire:model="goal" placeholder="Enter your fitness goal (e.g., lose weight, build muscle)">
                        @error('goal') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fitnessLevel" class="form-label">Fitness Level</label>
                        <select id="fitnessLevel" class="form-select" wire:model="fitnessLevel">
                            <option value="">Select your fitness level</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                        @error('fitnessLevel') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="availableTime" class="form-label">Available Time (in minutes)</label>
                        <input type="number" id="availableTime" class="form-control" wire:model="availableTime" placeholder="Enter time in minutes (e.g., 30)" min="10">
                        @error('availableTime') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Workout Plan</span>
                        <span wire:loading>Generating...</span>
                    </button>
                </form>
            </div>
        </div>

        @if($errorMessage)
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        @if($workoutPlan)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Your Personalized Workout Plan</h5>
                    <pre style="white-space: pre-wrap;">{{ $workoutPlan }}</pre>
                </div>
            </div>
        @else
            <div class="text-muted">Enter your details above and click "Generate Workout Plan" to see your personalized routine.</div>
        @endif
    </div>
</div>
