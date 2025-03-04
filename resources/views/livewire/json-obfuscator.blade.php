<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">JSON Obfuscator</h2>
        </div>
        <div class="card-body">
            <label for="jsonInput" class="form-label fw-bold">Enter JSON</label>
            <textarea wire:model="jsonInput" id="jsonInput" class="form-control text-dark border border-secondary" 
                      rows="5" placeholder="Paste your JSON here"></textarea>

            <button wire:click="obfuscateJson" class="btn btn-success mt-3 w-100">
                Obfuscate JSON
            </button>

            @if($obfuscatedJson)
                <div class="mt-4">
                    <h3 class="fw-semibold">Obfuscated JSON:</h3>
                    <pre class="bg-light border p-3 rounded text-dark">{{ $obfuscatedJson }}</pre>
                </div>
            @endif
        </div>
    </div>
</div>
