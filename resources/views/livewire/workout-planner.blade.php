<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Workout Planner</h1>

    <div class="mb-4">
        <h2 class="h5">Add Workout</h2>
        <form wire:submit.prevent="addWorkout" class="mb-4">
            <div class="mb-3">
                <label for="workoutName" class="form-label">Workout Name</label>
                <input 
                    type="text" 
                    wire:model="newWorkout.name" 
                    id="workoutName" 
                    class="form-control">
                @error('newWorkout.name') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="workoutType" class="form-label">Workout Type</label>
                <select 
                    wire:model="newWorkout.type" 
                    id="workoutType" 
                    class="form-select">
                    <option value="">Select Type</option>
                    @foreach($workoutTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                @error('newWorkout.type') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="workoutDuration" class="form-label">Duration (minutes)</label>
                <input 
                    type="number" 
                    wire:model="newWorkout.duration" 
                    id="workoutDuration" 
                    class="form-control">
                @error('newWorkout.duration') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="workoutDate" class="form-label">Date</label>
                <input 
                    type="date" 
                    wire:model="newWorkout.date" 
                    id="workoutDate" 
                    class="form-control">
                @error('newWorkout.date') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Workout</button>
        </form>
    </div>

    <h2 class="h5 mb-4">Planned Workouts</h2>
    <ul class="list-group">
        @foreach($workouts as $workout)
            <li class="list-group-item">
                <p><strong>Name:</strong> {{ $workout['name'] }}</p>
                <p><strong>Type:</strong> {{ $workout['type'] }}</p>
                <p><strong>Duration:</strong> {{ $workout['duration'] }} minutes</p>
                <p><strong>Date:</strong> {{ $workout['date'] }}</p>
            </li>
        @endforeach
    </ul>

    @if(empty($workouts))
        <p class="text-muted mt-4">No workouts planned yet. Start creating your fitness routine!</p>
    @endif
</div>
