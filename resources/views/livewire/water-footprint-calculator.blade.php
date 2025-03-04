<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Water Footprint Calculator</h1>

    <h2 class="h5 mb-4">Enter Your Daily Habits</h2>
    <form wire:submit.prevent="calculateWaterUsage" class="mb-4">
        @foreach($habits as $index => $habit)
            <div class="mb-3">
                <label class="form-label">{{ $habit['name'] }}</label>
                <div class="input-group">
                    <input 
                        type="number" 
                        min="0" 
                        wire:model="habits.{{ $index }}.quantity" 
                        class="form-control" 
                        placeholder="Number of {{ strtolower($habit['name']) }}">
                    <span class="input-group-text">{{ $habit['usage'] }} liters per unit</span>
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>

    <h2 class="h5 mt-4">Total Water Usage</h2>
    <p class="fs-4 fw-bold">{{ $totalWaterUsage }} liters/day</p>
</div>
