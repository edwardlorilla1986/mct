<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Payoff Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculatePayoff">
                <!-- Loan Amount -->
                <div class="mb-3">
                    <label for="loanAmount" class="form-label">Loan Amount ($)</label>
                    <input type="number" class="form-control" id="loanAmount" wire:model="loanAmount" placeholder="Enter total loan amount" required>
                </div>

                <!-- Monthly Payment -->
                <div class="mb-3">
                    <label for="monthlyPayment" class="form-label">Monthly Payment ($)</label>
                    <input type="number" class="form-control" id="monthlyPayment" wire:model="monthlyPayment" placeholder="Enter your monthly payment" required>
                </div>

                <!-- Interest Rate -->
                <div class="mb-3">
                    <label for="interestRate" class="form-label">Annual Interest Rate (%)</label>
                    <input type="number" class="form-control" id="interestRate" wire:model="interestRate" placeholder="Enter annual interest rate" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Calculate Payoff</button>
            </form>

            <!-- Results -->
            @if ($timeToPayoff > 0)
                <div class="alert alert-success mt-4">
                    <h5>Results:</h5>
                    <p><strong>Time to Payoff:</strong> {{ $timeToPayoff }} months</p>
                </div>

                <!-- Accelerated Payoff Schedule -->
                <h5 class="mt-4">Accelerated Payoff Schedule:</h5>
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
                        @foreach ($acceleratedSchedule as $payment)
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
