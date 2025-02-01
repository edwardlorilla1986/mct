<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Title Case Converter</h4>
        </div>
        <div class="card-body">
            <p>Enter a title below, and it will be converted to Title Case.</p>

            <!-- Input Field -->
            <div class="mb-3">
                <textarea class="form-control" rows="3" wire:model="inputText" placeholder="Enter your title here..."></textarea>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" wire:click="convertToTitleCase">Convert</button>
                <button class="btn btn-danger" wire:click="clearText">Clear</button>
            </div>

            @if ($convertedText)
                <!-- Converted Title -->
                <div class="mt-4">
                    <h5>Converted Title</h5>
                    <p class="border p-2 rounded">{{ $convertedText }}</p>
                </div>

                <!-- Stats -->
                <div class="mt-4">
                    <h5>Statistics</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Words:</strong> {{ $wordCount }}</li>
                        <li class="list-group-item"><strong>Characters:</strong> {{ $charCount }}</li>
                        <li class="list-group-item"><strong>Sentences:</strong> {{ $sentenceCount }}</li>
                        <li class="list-group-item"><strong>Whitespaces:</strong> {{ $whitespaceCount }}</li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
