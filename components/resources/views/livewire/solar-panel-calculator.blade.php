<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Solar Panel Calculator</h1>

    <form wire:submit.prevent="calculate" class="mb-4">
        <div class="mb-3">
            <label for="averageMonthlyBill" class="form-label">Average Monthly Electricity Bill ($)</label>
            <input 
                type="number" 
                wire:model="averageMonthlyBill" 
                id="averageMonthlyBill" 
                class="form-control">
            @error('averageMonthlyBill') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="sunHoursPerDay" class="form-label">Average Sun Hours Per Day</label>
            <input 
                type="number" 
                step="0.1" 
                wire:model="sunHoursPerDay" 
                id="sunHoursPerDay" 
                class="form-control">
            @error('sunHoursPerDay') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="panelEfficiency" class="form-label">Solar Panel Efficiency (%)</label>
            <input 
                type="number" 
                step="0.1" 
                wire:model="panelEfficiency" 
                id="panelEfficiency" 
                class="form-control">
            @error('panelEfficiency') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>

    @if($systemSize)
        <div class="mt-4">
            <h2 class="h5">Calculation Results</h2>
            <p><strong>System Size Required:</strong> {{ $systemSize }} kW</p>
            <p><strong>Total Installation Cost:</strong> ${{ number_format($totalCost, 2) }}</p>
            <p><strong>Yearly Savings:</strong> ${{ number_format($savingsPerYear, 2) }}</p>
            <p><strong>Payback Period:</strong> {{ number_format($paybackPeriod, 2) }} years</p>
        </div>
    @endif
</div>
