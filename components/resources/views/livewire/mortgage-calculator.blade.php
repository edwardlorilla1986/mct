<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Mortgage Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateMortgage">
                <!-- Loan Amount -->
                <div class="mb-3">
                    <label for="loanAmount" class="form-label">Loan Amount ($)</label>
                    <input type="number" class="form-control" id="loanAmount" wire:model="loanAmount" placeholder="Enter loan amount" required>
                </div>

                <!-- Interest Rate -->
                <div class="mb-3">
                    <label for="interestRate" class="form-label">Annual Interest Rate (%)</label>
                    <input type="number" class="form-control" id="interestRate" wire:model="interestRate" placeholder="Enter annual interest rate" required>
                </div>

                <!-- Loan Term -->
                <div class="mb-3">
                    <label for="loanTerm" class="form-label">Loan Term (Years)</label>
                    <input type="number" class="form-control" id="loanTerm" wire:model="loanTerm" placeholder="Enter loan term in years" required>
                </div>

                <!-- Down Payment -->
                <div class="mb-3">
                    <label for="downPayment" class="form-label">Down Payment ($)</label>
                    <input type="number" class="form-control" id="downPayment" wire:model="downPayment" placeholder="Enter down payment" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate Mortgage</button>
            </form>

            <!-- Results -->
            @if ($monthlyPayment > 0)
                <div class="alert alert-success mt-4">
                    <h5>Results:</h5>
                    <p><strong>Monthly Payment:</strong> ${{ number_format($monthlyPayment, 2) }}</p>
                    <p><strong>Total Interest:</strong> ${{ number_format($totalInterest, 2) }}</p>
                </div>

                <!-- Payment Schedule -->
                <h5 class="mt-4">Payment Schedule:</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Remaining Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentSchedule as $payment)
                            <tr>
                                <td>{{ $payment['month'] }}</td>
                                <td>${{ number_format($payment['principal'], 2) }}</td>
                                <td>${{ number_format($payment['interest'], 2) }}</td>
                                <td>${{ number_format($payment['balance'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
