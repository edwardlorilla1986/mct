<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-danger text-white">
            <h2 class="mb-0">JSON Data Censor</h2>
        </div>
        <div class="card-body">
            <label for="jsonInput" class="form-label fw-bold">Enter JSON</label>
            <textarea wire:model="jsonInput" id="jsonInput" class="form-control text-dark border border-secondary" 
                      rows="5" placeholder="Paste your JSON here"></textarea>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Censor Strings</label>
                    <textarea wire:model="stringCensors" class="form-control" rows="3" placeholder="Enter words to censor"></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Censor Keys</label>
                    <textarea wire:model="censorKeys" class="form-control" rows="3" placeholder="Enter keys to censor"></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Censor Numbers</label>
                    <textarea wire:model="censorNumbers" class="form-control" rows="3" placeholder="Enter numbers to censor"></textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">String Replacement</label>
                    <input type="text" wire:model="stringReplacement" class="form-control" placeholder="***">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Key Replacement</label>
                    <input type="text" wire:model="keyReplacement" class="form-control" placeholder="[HIDDEN]">
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label fw-bold">Indentation Type</label>
                <select wire:model="indentType" class="form-select">
                    <option value="space">Space Indents</option>
                    <option value="tab">Tab Indents</option>
                    <option value="none">Minified (No Indents)</option>
                </select>
            </div>

            <div class="mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="maskEachSymbol">
                    <label class="form-check-label">Mask Each Symbol</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="caseSensitive">
                    <label class="form-check-label">Case Sensitive</label>
                </div>
            </div>

            <button wire:click="censorJson" class="btn btn-danger mt-3 w-100">
                Censor JSON
            </button>

            @if($censoredJson)
                <div class="mt-4">
                    <h3 class="fw-semibold">Censored JSON Output:</h3>
                    <pre class="bg-light border p-3 rounded text-dark">{{ $censoredJson }}</pre>
                </div>
            @endif
        </div>
    </div>
</div>
