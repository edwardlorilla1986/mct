<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Net Worth Tracker</h1>

    <div class="mb-4">
        <h2 class="h5">Add Asset</h2>
        <form wire:submit.prevent="addAsset" class="mb-4">
            <div class="mb-3">
                <label for="assetName" class="form-label">Asset Name</label>
                <input 
                    type="text" 
                    wire:model="newAsset.name" 
                    id="assetName" 
                    class="form-control">
                @error('newAsset.name') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="assetValue" class="form-label">Value</label>
                <input 
                    type="number" 
                    wire:model="newAsset.value" 
                    id="assetValue" 
                    class="form-control">
                @error('newAsset.value') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Add Asset</button>
        </form>
    </div>

    <div class="mb-4">
        <h2 class="h5">Add Liability</h2>
        <form wire:submit.prevent="addLiability" class="mb-4">
            <div class="mb-3">
                <label for="liabilityName" class="form-label">Liability Name</label>
                <input 
                    type="text" 
                    wire:model="newLiability.name" 
                    id="liabilityName" 
                    class="form-control">
                @error('newLiability.name') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="liabilityValue" class="form-label">Value</label>
                <input 
                    type="number" 
                    wire:model="newLiability.value" 
                    id="liabilityValue" 
                    class="form-control">
                @error('newLiability.value') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <button type="submit" class="btn btn-danger">Add Liability</button>
        </form>
    </div>

    <h2 class="h5 mb-3">Summary</h2>
    <p><strong>Total Assets:</strong> ${{ number_format($totalAssets, 2) }}</p>
    <p><strong>Total Liabilities:</strong> ${{ number_format($totalLiabilities, 2) }}</p>
    <p><strong>Net Worth:</strong> ${{ number_format($netWorth, 2) }}</p>

    <h2 class="h5 mt-4">Assets</h2>
    <ul class="list-group mb-4">
        @foreach($assets as $asset)
            <li class="list-group-item">
                {{ $asset['name'] }}: ${{ number_format($asset['value'], 2) }}
            </li>
        @endforeach
    </ul>

    <h2 class="h5 mt-4">Liabilities</h2>
    <ul class="list-group">
        @foreach($liabilities as $liability)
            <li class="list-group-item">
                {{ $liability['name'] }}: ${{ number_format($liability['value'], 2) }}
            </li>
        @endforeach
    </ul>
</div>
