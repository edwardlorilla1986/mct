<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Stock ROI Calculator</h1>

    <form wire:submit.prevent="addStock" class="mb-4">
        <div class="mb-3">
            <label for="stockName" class="form-label">Stock Name</label>
            <input 
                type="text" 
                wire:model="newStock.name" 
                id="stockName" 
                class="form-control">
            @error('newStock.name') 
                <div class="text-danger small">{{ $message }}</div> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="purchasePrice" class="form-label">Purchase Price</label>
            <input 
                type="number" 
                wire:model="newStock.purchasePrice" 
                id="purchasePrice" 
                class="form-control">
            @error('newStock.purchasePrice') 
                <div class="text-danger small">{{ $message }}</div> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="currentPrice" class="form-label">Current Price</label>
            <input 
                type="number" 
                wire:model="newStock.currentPrice" 
                id="currentPrice" 
                class="form-control">
            @error('newStock.currentPrice') 
                <div class="text-danger small">{{ $message }}</div> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="shares" class="form-label">Number of Shares</label>
            <input 
                type="number" 
                wire:model="newStock.shares" 
                id="shares" 
                class="form-control">
            @error('newStock.shares') 
                <div class="text-danger small">{{ $message }}</div> 
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add Stock</button>
    </form>

    <h2 class="h5 mb-4">Stock Portfolio</h2>
    <div class="mb-4">
        @if(count($stocks) > 0)
            <div class="list-group">
                @foreach($stocks as $stock)
                    <div class="list-group-item">
                        <h3 class="h6">{{ $stock['name'] }}</h3>
                        <p><strong>Purchase Price:</strong> ${{ number_format($stock['purchasePrice'], 2) }}</p>
                        <p><strong>Current Price:</strong> ${{ number_format($stock['currentPrice'], 2) }}</p>
                        <p><strong>Shares:</strong> {{ $stock['shares'] }}</p>
                        <p><strong>Investment:</strong> ${{ number_format($stock['investment'], 2) }}</p>
                        <p><strong>Current Value:</strong> ${{ number_format($stock['currentValue'], 2) }}</p>
                        <p><strong>ROI:</strong> {{ number_format($stock['roi'], 2) }}%</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No stocks added yet. Start building your portfolio!</p>
        @endif
    </div>

    <h2 class="h5 mt-4">Totals</h2>
    <p><strong>Total Investment:</strong> ${{ number_format($totalInvestment, 2) }}</p>
    <p><strong>Total Current Value:</strong> ${{ number_format($totalCurrentValue, 2) }}</p>
    <p><strong>Total ROI:</strong> {{ number_format($totalROI, 2) }}%</p>
</div>
