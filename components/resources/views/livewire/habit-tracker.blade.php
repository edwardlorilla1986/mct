<div class="p-6 bg-white shadow-md rounded">
    <h1 class="text-xl font-bold mb-4">Advanced Habit Tracker</h1>

    <form wire:submit.prevent="addHabit" class="mb-4">
        <div class="mb-2">
            <label for="habitName" class="block text-sm font-medium">Habit Name</label>
            <input type="text" id="habitName" wire:model="habitName" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            @error('habitName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label for="startDate" class="block text-sm font-medium">Start Date</label>
            <input type="date" id="startDate" wire:model="startDate" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            @error('startDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded shadow">Add Habit</button>
    </form>

    <h2 class="text-lg font-bold mb-2">Habits</h2>
    <div class="space-y-4">
        @foreach($habits as $habitIndex => $habit)
            <div class="p-4 bg-gray-100 rounded">
                <h3 class="text-lg font-medium">{{ $habit['name'] }}</h3>
                <p class="text-sm text-gray-600">Start Date: {{ $habit['start_date'] }}</p>

                @if(empty($habit['days']))
                    <button wire:click="generateDays({{ $habitIndex }})" class="mt-2 px-3 py-1 bg-green-600 text-white rounded">Generate Week</button>
                @else
                    <div class="grid grid-cols-7 gap-2 mt-4">
                        @foreach($habit['days'] as $dayIndex => $day)
                            <div class="p-2 border rounded {{ $day['completed'] ? 'bg-green-200' : 'bg-gray-200' }}">
                                <p class="text-xs font-medium">{{ $day['date'] }}</p>
                                <button wire:click="toggleCompletion({{ $habitIndex }}, {{ $dayIndex }})" class="mt-1 px-2 py-1 text-xs bg-blue-600 text-white rounded">
                                    {{ $day['completed'] ? 'Undo' : 'Complete' }}
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @if(empty($habits))
        <p class="text-gray-500 mt-4">No habits added yet. Start building consistency!</p>
    @endif
</div>
