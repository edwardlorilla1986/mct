<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Random Joke Generator</h4>
        </div>
        <div class="card-body text-center">
            <div class="mb-3">
                <label for="type" class="form-label">Choose Joke Type:</label>
                <select class="form-control w-50 d-inline-block" wire:model="type">
                    <option value="general">General</option>
                    <option value="programming">Programming</option>
                </select>
            </div>

            @if ($joke)
                <div class="joke-box p-3 bg-light rounded shadow-sm">
                    <h5>{{ $joke['setup'] }}</h5>
                    <p class="fw-bold">{{ $joke['punchline'] }}</p>
                </div>
            @else
                <p class="text-muted">Click the button to get a joke.</p>
            @endif

            <button class="btn btn-success mt-3" wire:click="fetchJoke">Get Another Joke</button>
        </div>
    </div>
</div>
