<div class="container mt-4">
    <h1 class="text-primary">JSON Syntax Highlighter</h1>
    <div class="form-group">
        <label class="font-weight-bold">JSON Input:</label>
        <textarea class="form-control" wire:model="jsonInput" rows="10"></textarea>
    </div>
    
    <div class="form-check">
        <input type="checkbox" class="form-check-input" wire:model="showLineNumbers">
        <label class="form-check-label">Show Line Numbers</label>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" wire:model="showSpecialChars">
        <label class="form-check-label">Show Special Characters</label>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" wire:model="matchBrackets">
        <label class="form-check-label">Match Brackets</label>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" wire:model="highlightActiveLine">
        <label class="form-check-label">Highlight Active Line</label>
    </div>

    @if (session()->has('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    <pre class="bg-dark text-light p-3 mt-3 border rounded">
        {{ json_encode(json_decode($jsonInput, true), JSON_PRETTY_PRINT) }}
    </pre>
</div>
