<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Heart Rate Zone Calculator</h1>

    <form wire:submit.prevent="calculateZones" class="mb-4">
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input 
                type="number" 
                wire:model="age" 
                id="age" 
                class="form-control" 
                placeholder="Enter your age">
            @error('age') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="restingHeartRate" class="form-label">Resting Heart Rate</label>
            <input 
                type="number" 
                wire:model="restingHeartRate" 
                id="restingHeartRate" 
                class="form-control" 
                placeholder="Enter your resting heart rate">
            @error('restingHeartRate') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Calculate Zones</button>
    </form>

    <h2 class="h5 mb-3">Target Heart Rate Zones</h2>
    @if(!empty($zones))
        <ul class="list-group">
            @foreach($zones as $zone)
                <li class="list-group-item">
                    <strong>{{ $zone['name'] }}:</strong> {{ $zone['min'] }} - {{ $zone['max'] }} BPM
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">Enter your details to calculate your heart rate zones.</p>
    @endif
</div>
