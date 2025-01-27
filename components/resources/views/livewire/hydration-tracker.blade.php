<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Hydration Tracker</h1>

    <div class="mb-4">
        <h2 class="h5">Daily Water Intake Goal</h2>
        <p>{{ $dailyGoal }} ml</p>
    </div>

    <div class="mb-4">
        <h2 class="h5">Add Water Intake</h2>
        <form wire:submit.prevent="addIntake" class="mb-4">
            <div class="mb-3">
                <label for="intakeAmount" class="form-label">Amount (ml)</label>
                <input 
                    type="number" 
                    wire:model="newIntake.amount" 
                    id="intakeAmount" 
                    class="form-control">
                @error('newIntake.amount') 
                    <div class="text-danger small mt-1">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="intakeTime" class="form-label">Time</label>
                <input 
                    type="time" 
                    wire:model="newIntake.time" 
                    id="intakeTime" 
                    class="form-control">
                @error('newIntake.time') 
                    <div class="text-danger small mt-1">{{ $message }}</div> 
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Intake</button>
        </form>
    </div>

    <h2 class="h5 mb-3">Today's Water Intake</h2>
    <div class="mb-4">
        <div class="progress">
            <div 
                class="progress-bar bg-info" 
                role="progressbar" 
                style="width: {{ $progress }}%;" 
                aria-valuenow="{{ $progress }}" 
                aria-valuemin="0" 
                aria-valuemax="100">
            </div>
        </div>
        <p class="mt-2">{{ $totalIntake }} ml / {{ $dailyGoal }} ml</p>
    </div>

    <h2 class="h5 mb-3">Water Intake Records</h2>
    <ul class="list-group">
        @foreach($waterIntakeRecords as $record)
            <li class="list-group-item">
                <p><strong>Amount:</strong> {{ $record['amount'] }} ml</p>
                <p><strong>Time:</strong> {{ $record['time'] }}</p>
            </li>
        @endforeach
    </ul>

    @if(empty($waterIntakeRecords))
        <p class="text-muted mt-4">No water intake records yet. Start tracking your hydration!</p>
    @endif
</div>
