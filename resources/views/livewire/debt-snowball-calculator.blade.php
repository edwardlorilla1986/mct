<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Debt Snowball Calculator</h1>

    <div class="mb-4">
        <h2 class="h5">Add Debt</h2>
        <form wire:submit.prevent="addDebt" class="mb-4">
            <div class="mb-3">
                <label for="debtName" class="form-label">Debt Name</label>
                <input 
                    type="text" 
                    wire:model="newDebt.name" 
                    id="debtName" 
                    class="form-control">
                @error('newDebt.name') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="debtBalance" class="form-label">Balance</label>
                <input 
                    type="number" 
                    wire:model="newDebt.balance" 
                    id="debtBalance" 
                    class="form-control">
                @error('newDebt.balance') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="interestRate" class="form-label">Interest Rate (%)</label>
                <input 
                    type="number" 
                    step="0.01" 
                    wire:model="newDebt.interestRate" 
                    id="interestRate" 
                    class="form-control">
                @error('newDebt.interestRate') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="mb-3">
                <label for="minPayment" class="form-label">Minimum Payment</label>
                <input 
                    type="number" 
                    wire:model="newDebt.minPayment" 
                    id="minPayment" 
                    class="form-control">
                @error('newDebt.minPayment') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Debt</button>
        </form>
    </div>

    <div class="mb-4">
        <h2 class="h5">Extra Payment</h2>
        <input 
            type="number" 
            wire:model="extraPayment" 
            class="form-control" 
            placeholder="Enter extra monthly payment">
        @error('extraPayment') 
            <div class="text-danger small mt-1">{{ $message }}</div> 
        @enderror
    </div>

    <button wire:click="calculatePlan" class="btn btn-success mb-4">Calculate Payment Plan</button>

    <div>
        <h2 class="h5">Payment Plan</h2>
        @if(!empty($paymentPlan))
            <div class="list-group">
                @foreach($paymentPlan as $plan)
                    <div class="list-group-item">
                        <h3 class="h6">{{ $plan['name'] }}</h3>
                        <ul class="list-group">
                            @foreach($plan['payments'] as $payment)
                                <li class="list-group-item">
                                    Month {{ $payment['month'] }}: Paid ${{ number_format($payment['payment'], 2) }} | Remaining: ${{ number_format($payment['remainingBalance'], 2) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No payment plan calculated yet.</p>
        @endif
    </div>
</div>
