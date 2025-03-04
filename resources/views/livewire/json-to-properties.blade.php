<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0">JSON to Properties Converter</h2>
        </div>
        <div class="card-body">
            <label for="jsonInput" class="form-label fw-bold">Enter JSON</label>
            <textarea wire:model="jsonInput" id="jsonInput" class="form-control text-dark border border-secondary" 
                      rows="5" placeholder="Paste your JSON here"></textarea>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Key-Value Separator</label>
                    <select wire:model="keyValueSeparator" class="form-select">
                        <option value="=">Equal Sign (=)</option>
                        <option value=":">Colon (:)</option>
                        <option value=">">Custom Separator (>)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Object Key Separator</label>
                    <select wire:model="objectKeySeparator" class="form-select">
                        <option value=".">Dot (.)</option>
                        <option value="_">Underscore (_)</option>
                        <option value="+">Custom Separator (+)</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Array Index Format</label>
                    <select wire:model="indexFormat" class="form-select">
                        <option value="brackets">Brackets [0]</option>
                        <option value="dot">Dot .0</option>
                        <option value="custom">Custom ( )</option>
                    </select>
                </div>
                @if($indexFormat == 'custom')
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Custom Left Wrapper</label>
                        <input type="text" wire:model="customIndexWrapperLeft" class="form-control" placeholder="( ">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Custom Right Wrapper</label>
                        <input type="text" wire:model="customIndexWrapperRight" class="form-control" placeholder=" )">
                    </div>
                @endif
            </div>

            <button wire:click="convertJsonToProperties" class="btn btn-success mt-3 w-100">
                Convert JSON to Properties
            </button>

            @if($propertiesOutput)
                <div class="mt-4">
                    <h3 class="fw-semibold">Properties Output:</h3>
                    <pre class="bg-light border p-3 rounded text-dark">{{ $propertiesOutput }}</pre>
                </div>
            @endif
        </div>
    </div>
</div>
