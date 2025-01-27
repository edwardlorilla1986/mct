<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Body Fat Percentage Calculator</h1>

    {{-- Display Error Messages --}}
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form --}}
    <form wire:submit.prevent="calculateBodyFatPercentage" class="mb-4">
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select wire:model="gender" id="gender" class="form-select">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            @error('gender') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input 
                type="number" 
                wire:model="age" 
                id="age" 
                class="form-control">
            @error('age') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Weight (kg)</label>
            <input 
                type="number" 
                wire:model="weight" 
                id="weight" 
                class="form-control">
            @error('weight') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Height (cm)</label>
            <input 
                type="number" 
                wire:model="height" 
                id="height" 
                class="form-control">
            @error('height') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="waistCircumference" class="form-label">Waist Circumference (cm)</label>
            <input 
                type="number" 
                wire:model="waistCircumference" 
                id="waistCircumference" 
                class="form-control">
            @error('waistCircumference') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="neckCircumference" class="form-label">Neck Circumference (cm)</label>
            <input 
                type="number" 
                wire:model="neckCircumference" 
                id="neckCircumference" 
                class="form-control">
            @error('neckCircumference') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Display Hip Circumference Only for Females --}}
        @if($gender === 'female')
            <div class="mb-3">
                <label for="hipCircumference" class="form-label">Hip Circumference (cm)</label>
                <input 
                    type="number" 
                    wire:model="hipCircumference" 
                    id="hipCircumference" 
                    class="form-control">
                @error('hipCircumference') 
                    <div class="text-danger small mt-1">{{ $message }}</div> 
                @enderror
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>

    {{-- Display Body Fat Percentage Result --}}
    @if($bodyFatPercentage !== null)
        <div class="mt-4">
            <h2 class="h5">Your Body Fat Percentage</h2>
            <p class="fs-4 fw-bold">{{ $bodyFatPercentage }}%</p>
        </div>
    @endif
</div>
