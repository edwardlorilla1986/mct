<div>
    <h2 class="text-lg font-bold mb-2">JSON to List Converter</h2>
    <textarea wire:model="jsonInput" class="w-full p-2 border rounded" placeholder="Enter JSON here..."></textarea>
    
    @if ($errorMessage)
        <p class="text-red-500 mt-2">{{ $errorMessage }}</p>
    @endif
    
    @if (!empty($listData))
        <ul class="mt-4 border rounded p-4 bg-gray-100">
            @foreach ($listData as $item)
                <li class="p-2 border-b">
                    {{ is_array($item) ? json_encode($item) : $item }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
