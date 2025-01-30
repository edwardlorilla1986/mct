<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Random Fake User Generator</h4>
        </div>
        <div class="card-body text-center">
            @if ($user)
                <img src="{{ $user['picture']['large'] }}" class="img-fluid rounded-circle mb-3" width="150" alt="User Image">
                <h5>{{ $user['name']['title'] }} {{ $user['name']['first'] }} {{ $user['name']['last'] }}</h5>
                <p class="text-muted"><strong>Gender:</strong> {{ ucfirst($user['gender']) }}</p>
                <p><strong>Email:</strong> {{ $user['email'] }}</p>
                <p><strong>Phone:</strong> {{ $user['phone'] }}</p>
                <p><strong>Cell:</strong> {{ $user['cell'] }}</p>
                <p><strong>Address:</strong> {{ $user['location']['street']['number'] }} {{ $user['location']['street']['name'] }}, 
                {{ $user['location']['city'] }}, {{ $user['location']['state'] }}, {{ $user['location']['country'] }}</p>
                <p><strong>Nationality:</strong> {{ $user['nat'] }}</p>
            @else
                <p class="text-muted">Click the button to generate a fake user.</p>
            @endif

            <button class="btn btn-success mt-3" wire:click="fetchFakeUser">Generate New User</button>
        </div>
    </div>

    <!-- Alert Message -->
    <script>
        window.addEventListener('show-alert', event => {
            alert(event.detail.message);
        });
    </script>
</div>
