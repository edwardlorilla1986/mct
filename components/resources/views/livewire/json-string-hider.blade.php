<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">JSON String Hider</h4>
        </div>
        <div class="card-body">
            <!-- JSON Input -->
            <div class="form-group">
                <label for="jsonInput">Enter JSON:</label>
                <textarea class="form-control" wire:model.lazy="jsonInput" rows="6" placeholder='{"key": "value"}'></textarea>
            </div>

            <!-- Encoding Type -->
            <div class="form-group mt-3">
                <label for="encodingType">Encoding Type:</label>
                <select class="form-control" wire:model="encodingType">
                    <option value="surrogate">Surrogate Pairs (\uHHHH)</option>
                    <option value="hex">Hex Bytes (\xHH)</option>
                    <option value="unicode">Unicode Code Points (\u{HHHHH})</option>
                </select>
            </div>

            <!-- Options -->
            <div class="form-check mt-3">
                <input type="checkbox" class="form-check-input" id="hideKeys" wire:model="hideKeys">
                <label class="form-check-label" for="hideKeys">Hide Object Keys</label>
            </div>

            <!-- Convert Button -->
            <div class="mt-3">
                <button class="btn btn-primary w-100" wire:click="encodeJson">Encode JSON</button>
            </div>

            <!-- Output -->
            @if($encodedJson)
            <div class="mt-4">
                <label>Encoded JSON Output:</label>
                <pre class="bg-light p-3 border rounded">{{ $encodedJson }}</pre>
            </div>
            @endif
        </div>
    </div>
</div>
