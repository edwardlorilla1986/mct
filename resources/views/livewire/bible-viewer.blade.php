<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Bible Viewer</h4>
        </div>
        <div class="card-body">

            <!-- Select Book -->
            <div class="mb-3">
                <label for="book" class="form-label">Select Book:</label>
                <select class="form-control" wire:model="selectedBook" wire:change="fetchChapters">
                    <option value="">-- Select a Book --</option>
                    @foreach ($books as $book)
                        <option value="{{ $book['id'] }}">{{ $book['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select Chapter -->
            @if ($chapters)
                <div class="mb-3">
                    <label for="chapter" class="form-label">Select Chapter:</label>
                    <select class="form-control" wire:model="selectedChapter" wire:change="fetchVerses">
                        <option value="">-- Select a Chapter --</option>
                        @foreach ($chapters as $chapter)
                            <option value="{{ $chapter['chapter'] }}">Chapter {{ $chapter['chapter'] }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Display Verses -->
            @if ($verses)
                <div class="mt-4">
                    <h5>Verses:</h5>
                    <ul class="list-group">
                        @foreach ($verses as $verse)
                            <li class="list-group-item">
                                <strong>{{ $verse['chapter'] }}:{{ $verse['verse'] }}</strong> - {{ $verse['text'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>
