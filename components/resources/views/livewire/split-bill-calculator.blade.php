<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Split Bill Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateSplit">
                <!-- Total Bill -->
                <div class="mb-3">
                    <label for="totalBill" class="form-label">Total Bill Amount ($)</label>
                    <input type="number" class="form-control" id="totalBill" wire:model="totalBill" placeholder="Enter total bill amount" required>
                </div>

                <!-- Number of People -->
                <div class="mb-3">
                    <label for="numPeople" class="form-label">Number of People</label>
                    <input type="number" class="form-control" id="numPeople" wire:model="numPeople" placeholder="Enter number of people" min="1" required>
                </div>

                <!-- Custom Splits -->
                <div class="mb-3">
                    <label class="form-label">Custom Splits (Optional)</label>
                    @foreach ($customSplits as $index => $split)
                        <div class="d-flex align-items-center mb-2">
                            <label class="me-2">Person {{ $index + 1 }}:</label>
                            <input type="number" class="form-control" wire:model="customSplits.{{ $index }}" placeholder="Custom amount" min="0">
                        </div>
                    @endforeach
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate</button>
            </form>

            <!-- Results -->
            @if ($perPersonCost > 0)
                <div class="alert alert-success mt-4">
                    <strong>Results:</strong>
                    <p>Shared Cost Per Person: ${{ number_format($perPersonCost, 2) }}</p>
                    <p>Remaining Amount: ${{ number_format($remainingAmount, 2) }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
