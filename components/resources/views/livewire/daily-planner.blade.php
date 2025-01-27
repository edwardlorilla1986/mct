<div class="p-6 bg-white shadow-md rounded">
    <h1 class="text-xl font-bold mb-4">Advanced Daily Planner</h1>

    <form wire:submit.prevent="addTask" class="mb-4">
        <div class="mb-2">
            <label for="task" class="block text-sm font-medium">Task</label>
            <input type="text" id="task" wire:model="task" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            @error('task') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label for="priority" class="block text-sm font-medium">Priority</label>
            <select id="priority" wire:model="priority" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                <option value="">Select Priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
            @error('priority') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label for="time" class="block text-sm font-medium">Time</label>
            <input type="time" id="time" wire:model="time" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded shadow">Add Task</button>
    </form>

    <h2 class="text-lg font-bold mb-2">Tasks</h2>
    <ul class="space-y-2">
        @foreach($tasks as $index => $task)
            <li class="p-4 bg-gray-100 rounded flex justify-between items-center">
                <div>
                    <p class="text-lg font-medium {{ $task['completed'] ? 'line-through text-gray-500' : '' }}">
                        {{ $task['task'] }} - <span class="text-sm text-gray-600">{{ $task['time'] }}</span>
                    </p>
                    <span class="text-sm text-gray-600">Priority: {{ ucfirst($task['priority']) }}</span>
                </div>

                <div class="flex space-x-2">
                    @if(!$task['completed'])
                        <button wire:click="markAsCompleted({{ $index }})" class="px-2 py-1 bg-green-600 text-white rounded">Complete</button>
                    @endif
                    <button wire:click="removeTask({{ $index }})" class="px-2 py-1 bg-red-600 text-white rounded">Remove</button>
                </div>
            </li>
        @endforeach
    </ul>

    @if(empty($tasks))
        <p class="text-gray-500 mt-4">No tasks added yet. Start planning your day!</p>
    @endif
</div>
