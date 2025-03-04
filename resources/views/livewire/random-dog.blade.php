<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Random Dog Image Generator</h4>
        </div>
        <div class="card-body text-center">
            @if ($dogImage)
                <img src="{{ $dogImage }}" class="img-fluid rounded shadow-sm" alt="Random Dog" width="400">
            @else
                <p class="text-muted">Click the button to generate a dog image.</p>
            @endif

            <button class="btn btn-success mt-3" wire:click="fetchRandomDog">Get Another Dog</button>
        </div>
    </div>

    <!-- Alert Message -->
    <script>
        window.addEventListener('show-alert', event => {
            alert(event.detail.message);
        });
    </script>
</div>
