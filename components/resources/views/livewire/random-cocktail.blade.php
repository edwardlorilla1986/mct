<div class="container mt-4">
    <div class="card shadow-lg">
        @if($cocktail)
            <img src="{{ $cocktail['strDrinkThumb'] }}" class="card-img-top" alt="{{ $cocktail['strDrink'] }}">
            <div class="card-body">
                <h3 class="card-title text-primary">{{ $cocktail['strDrink'] }}</h3>
                <span class="badge bg-success">{{ $cocktail['strAlcoholic'] }}</span>
                <span class="badge bg-info">{{ $cocktail['strCategory'] }}</span>
                <p class="mt-3"><strong>Glass Type:</strong> {{ $cocktail['strGlass'] }}</p>

                <!-- Language Selector -->
                <h5 class="mt-4">Select Language:</h5>
                <div class="btn-group mb-3">
                    @foreach($languages as $code => $instructionKey)
                        <button wire:click="setLanguage('{{ $code }}')"
                                class="btn btn-sm {{ $selectedLanguage === $code ? 'btn-primary' : 'btn-outline-secondary' }}">
                            {{ strtoupper($code) }}
                        </button>
                    @endforeach
                </div>

                <!-- Ingredients -->
                <h5>Ingredients:</h5>
                <ul class="list-group">
                    @for ($i = 1; $i <= 15; $i++)
                        @php
                            $ingredient = $cocktail['strIngredient' . $i] ?? null;
                            $measure = $cocktail['strMeasure' . $i] ?? null;
                        @endphp
                        @if ($ingredient)
                            <li class="list-group-item">
                                {{ $measure }} {{ $ingredient }}
                            </li>
                        @endif
                    @endfor
                </ul>

                <!-- Instructions -->
                <h5 class="mt-4">Instructions ({{ $selectedLanguage }}):</h5>
                <p>
                    {{ $cocktail[$languages[$selectedLanguage]] ?? 'Instructions not available in this language.' }}
                </p>

                <button wire:click="fetchCocktail" class="btn btn-primary mt-3">Get Another Cocktail</button>
            </div>
        @else
            <div class="card-body">
                <p class="text-danger">No cocktail found.</p>
            </div>
        @endif
    </div>
</div>
