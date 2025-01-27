<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Event Budget Planner</h1>

    <form wire:submit.prevent="addCategory" class="mb-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="eventName" class="form-label">Event Name</label>
                <input 
                    type="text" 
                    wire:model="eventName" 
                    id="eventName" 
                    class="form-control" 
                    placeholder="Event Name">
                @error('eventName') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
            <div class="col-md-6">
                <label for="eventDate" class="form-label">Event Date</label>
                <input 
                    type="date" 
                    wire:model="eventDate" 
                    id="eventDate" 
                    class="form-control">
                @error('eventDate') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>
        </div>

        <div>
            <h2 class="h5 mb-2">Add Category</h2>
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <input 
                        type="text" 
                        wire:model="newCategory.name" 
                        placeholder="Category Name" 
                        class="form-control">
                    @error('newCategory.name') 
                        <div class="text-danger small">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="col-md-6">
                    <input 
                        type="number" 
                        wire:model="newCategory.budget" 
                        placeholder="Budget" 
                        class="form-control">
                    @error('newCategory.budget') 
                        <div class="text-danger small">{{ $message }}</div> 
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Category</button>
        </div>
    </form>

    <h2 class="h5 mb-4">Categories</h2>
    <div class="mb-4">
        @foreach($categories as $index => $category)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="h6">{{ $category['name'] }}</h3>
                    <p><strong>Budget:</strong> ${{ number_format($category['budget'], 2) }}</p>
                    <h4 class="h6 mt-3">Expenses</h4>
                    <ul class="list-group list-group-flush mb-3">
                        @foreach($category['expenses'] as $expense)
                            <li class="list-group-item">
                                {{ $expense['name'] }}: ${{ number_format($expense['amount'], 2) }}
                            </li>
                        @endforeach
                    </ul>
                    <form wire:submit.prevent="addExpense({{ $index }})" class="row g-3">
                        <div class="col-md-5">
                            <input 
                                type="text" 
                                wire:model.defer="expenseName" 
                                placeholder="Expense Name" 
                                class="form-control">
                        </div>
                        <div class="col-md-5">
                            <input 
                                type="number" 
                                wire:model.defer="expenseAmount" 
                                placeholder="Expense Amount" 
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">Add Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="h5 mt-4">Total Budget: ${{ number_format($totalBudget, 2) }}</h2>
</div>
