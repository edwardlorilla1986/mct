<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Random Meal Viewer</h4>
            <button class="btn btn-light" wire:click="fetchRandomMeal" wire:loading.attr="disabled">
                🔄 Get New Meal
            </button>
        </div>
        
        <div class="card-body">
            @if ($loading)
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p>Fetching a random meal...</p>
                </div>
            @elseif ($meal)
                <h2 class="text-center">{{ $meal['strMeal'] }}</h2>
                <p class="text-center">
                    <strong>Category:</strong> {{ $meal['strCategory'] }} |
                    <strong>Origin:</strong> {{ $meal['strArea'] }}
                </p>

                <div class="text-center">
                    <img src="{{ $meal['strMealThumb'] }}" alt="{{ $meal['strMeal'] }}" class="img-fluid rounded shadow-sm" style="max-width: 300px;">
                </div>

                <h4 class="mt-4">Ingredients</h4>
                <ul class="list-group">
                    @foreach ($this->getIngredients() as $ingredient)
                        <li class="list-group-item">{{ $ingredient }}</li>
                    @endforeach
                </ul>

                <h4 class="mt-4">Instructions</h4>
                <p>{{ $meal['strInstructions'] }}</p>

                <h4 class="mt-4">Watch Video</h4>
                @if (!empty($meal['strYoutube']))
                    <div class="text-center">
                        <iframe width="560" height="315" src="{{ str_replace('watch?v=', 'embed/', $meal['strYoutube']) }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @else
                    <p>No video available.</p>
                @endif

                @if (!empty($meal['strSource']))
                    <h4 class="mt-4">Recipe Source</h4>
                    <a href="{{ $meal['strSource'] }}" class="btn btn-info" target="_blank">View Original Recipe</a>
                @endif
            @else
                <p class="text-center">No meal data available.</p>
            @endif
        </div>
    </div>
</div>
