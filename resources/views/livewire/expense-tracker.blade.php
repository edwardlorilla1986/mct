<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Expense Tracker</h4>
        </div>
        <div class="card-body">
            <!-- Add Expense Form -->
            <form wire:submit.prevent="addExpense">
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" wire:model="newExpense.amount" step="0.01" placeholder="Enter amount" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" wire:model="newExpense.category" required>
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" wire:model="newExpense.date" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <input type="text" class="form-control" id="description" wire:model="newExpense.description" placeholder="Add a description">
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Expense</button>
            </form>

            <!-- Total Expenses and Budget Alert -->
            <div class="mt-4">
                <p><strong>Total Expenses:</strong> ${{ number_format($totalExpenses, 2) }}</p>
                <p><strong>Monthly Budget:</strong> ${{ number_format($budget, 2) }}</p>
                @if ($budgetAlert)
                    <div class="alert alert-danger">
                        <strong>Alert:</strong> You are nearing or exceeding your monthly budget!
                    </div>
                @endif
            </div>

            <!-- Expense List -->
            <div class="mt-4">
                <h5>Expense List</h5>
                @if (count($expenses) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Amount ($)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{ $expense['date'] }}</td>
                                    <td>{{ $expense['category'] }}</td>
                                    <td>{{ $expense['description'] }}</td>
                                    <td>{{ number_format($expense['amount'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No expenses logged yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
