<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Sleep Tracker</h1>

    <div class="mb-4">
        <h2 class="h5">Add Sleep Record</h2>
        <form wire:submit.prevent="addSleepRecord" class="mb-4">
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input 
                    type="date" 
                    wire:model="newSleepRecord.date" 
                    id="date" 
                    class="form-control">
                @error('newSleepRecord.date') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="sleepTime" class="form-label">Sleep Time</label>
                <input 
                    type="time" 
                    wire:model="newSleepRecord.sleepTime" 
                    id="sleepTime" 
                    class="form-control">
                @error('newSleepRecord.sleepTime') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="wakeTime" class="form-label">Wake Time</label>
                <input 
                    type="time" 
                    wire:model="newSleepRecord.wakeTime" 
                    id="wakeTime" 
                    class="form-control">
                @error('newSleepRecord.wakeTime') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Record</button>
        </form>
    </div>

    <h2 class="h5 mb-3">Sleep Records</h2>
    <div class="mb-4">
        @if(!empty($sleepRecords))
            <div class="list-group">
                @foreach($sleepRecords as $record)
                    <div class="list-group-item">
                        <p><strong>Date:</strong> {{ $record['date'] }}</p>
                        <p><strong>Sleep Time:</strong> {{ $record['sleepTime'] }}</p>
                        <p><strong>Wake Time:</strong> {{ $record['wakeTime'] }}</p>
                        <p><strong>Duration:</strong> {{ number_format($record['duration'], 2) }} hours</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No sleep records found. Start adding your sleep details!</p>
        @endif
    </div>

    <h2 class="h5 mt-4">Average Sleep Duration</h2>
    <p class="fw-bold">{{ number_format($averageSleepDuration, 2) }} hours</p>
</div>
