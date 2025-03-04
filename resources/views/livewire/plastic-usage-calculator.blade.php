<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Plastic Usage Calculator</h1>

    <h2 class="h5 mb-4">Enter Your Plastic Consumption</h2>
    <form wire:submit.prevent="calculatePlasticWaste" class="mb-4">
        <div class="mb-3">
            @foreach($plasticItems as $index => $item)
                <div class="mb-3">
                    <label class="form-label">{{ $item['name'] }}</label>
                    <div class="input-group">
                        <input 
                            type="number" 
                            min="0" 
                            wire:model="plasticItems.{{ $index }}.usage" 
                            class="form-control" 
                            placeholder="Number of {{ strtolower($item['name']) }} used">
                        <span class="input-group-text">{{ $item['weight'] }} kg per item</span>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>

    <h2 class="h5 mt-4">Total Plastic Waste</h2>
    <p class="fs-4 fw-bold">{{ number_format($totalPlasticWaste, 2) }} kg</p>

    <h2 class="h5 mt-4">Tips to Reduce Plastic Waste</h2>
    <ul class="list-group">
        @foreach($reductionTips as $tip)
            <li class="list-group-item">{{ $tip }}</li>
        @endforeach
    </ul>
</div>
