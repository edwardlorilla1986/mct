<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Step Counter</h1>

    <div class="mb-4">
        <h2 class="h5">Daily Step Goal</h2>
        <p>{{ $dailyGoal }} steps</p>
    </div>

    <div class="mb-4">
        <h2 class="h5">Add Steps</h2>
        <form wire:submit.prevent="addSteps" class="mb-4">
            <div class="mb-3">
                <label for="stepDate" class="form-label">Date</label>
                <input 
                    type="date" 
                    wire:model="newSteps.date" 
                    id="stepDate" 
                    class="form-control">
                @error('newSteps.date') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="stepCount" class="form-label">Steps</label>
                <input 
                    type="number" 
                    wire:model="newSteps.count" 
                    id="stepCount" 
                    class="form-control">
                @error('newSteps.count') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Steps</button>
        </form>
    </div>

    <h2 class="h5 mb-3">Today's Progress</h2>
    <div class="mb-4">
        <div class="progress">
            <div 
                class="progress-bar bg-success" 
                role="progressbar" 
                style="width: {{ $progress }}%;" 
                aria-valuenow="{{ $progress }}" 
                aria-valuemin="0" 
                aria-valuemax="100">
            </div>
        </div>
        <p class="mt-2">{{ $totalSteps }} steps / {{ $dailyGoal }} steps</p>
    </div>

    <h2 class="h5 mb-3">Step Records</h2>
    <ul class="list-group">
        @foreach($steps as $step)
            <li class="list-group-item">
                <p><strong>Date:</strong> {{ $step['date'] }}</p>
                <p><strong>Steps:</strong> {{ $step['count'] }}</p>
            </li>
        @endforeach
    </ul>

    @if(empty($steps))
        <p class="text-muted mt-4">No steps recorded yet. Start tracking your fitness goals!</p>
    @endif
</div>
