<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Kanji Explorer</h4>
        </div>
        <div class="card-body">

            <!-- Select Kanji List -->
            <div class="mb-3">
                <label for="category" class="form-label">Select Kanji Category:</label>
                <select class="form-control" wire:model="selectedCategory" wire:change="fetchKanjiList">
                    <option value="">-- Choose a Category --</option>
                    @foreach ($kanjiCategories as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            @if ($kanjiList)
                <div class="mt-3">
                    <h5>Kanji List:</h5>
                    <div class="kanji-grid">
                        @foreach ($kanjiList as $kanji)
                            <span class="kanji-item" wire:click="fetchKanjiDetails('{{ $kanji }}')">
                                {{ $kanji }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Search Kanji Details -->
            <div class="mb-3 mt-4">
                <label for="kanjiCharacter" class="form-label">Search Kanji Details:</label>
                <input type="text" class="form-control" wire:model="kanjiCharacter">
                <button class="btn btn-success mt-2" wire:click="fetchKanjiDetails">Search</button>
            </div>

            @if ($kanjiDetails)
                <div class="mt-3">
                    <h5>Kanji Details for "{{ $kanjiCharacter }}"</h5>
                    <p><strong>Meanings:</strong> {{ implode(', ', $kanjiDetails['meanings']) }}</p>
                    <p><strong>On Readings:</strong> {{ implode(', ', $kanjiDetails['on_readings']) }}</p>
                    <p><strong>Kun Readings:</strong> {{ implode(', ', $kanjiDetails['kun_readings']) }}</p>
                    <p><strong>Stroke Count:</strong> {{ $kanjiDetails['stroke_count'] }}</p>
                    <p><strong>JLPT Level:</strong> {{ $kanjiDetails['jlpt'] ?? 'N/A' }}</p>
                </div>
            @endif

            <!-- Search Kanji by Reading -->
            <div class="mb-3 mt-4">
                <label for="kanjiReading" class="form-label">Search Kanji by Reading:</label>
                <input type="text" class="form-control" wire:model="kanjiReading">
                <button class="btn btn-success mt-2" wire:click="fetchKanjiByReading">Search</button>
            </div>

            @if ($readingResults)
                <div class="mt-3">
                    <h5>Kanji Matching Reading "{{ $kanjiReading }}"</h5>
                    <p>{{ implode(', ', $readingResults['main_kanji']) }}</p>
                </div>
            @endif

        </div>
    </div>
</div>

<style>
    .kanji-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .kanji-item {
        font-size: 24px;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
