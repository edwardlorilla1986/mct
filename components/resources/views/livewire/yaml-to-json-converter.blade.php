<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4>YAML to JSON Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="yamlInput" class="form-label">Enter YAML:</label>
                <textarea id="yamlInput" wire:model="yamlInput" class="form-control" rows="5" placeholder='person:
  first_name: Jenna
  last_name: Mullins
status: active
city: Copenhagen
age: 25
interests:
  - music
  - reading
  - traveling'></textarea>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="useTabs" wire:model="useTabs" class="form-check-input">
                <label for="useTabs" class="form-check-label">Use Tabs for Indentation</label>
            </div>

            <div class="mb-3">
                <label for="indentationSize" class="form-label">Indentation Size (Spaces):</label>
                <input type="number" id="indentationSize" wire:model="indentationSize" class="form-control" min="0" max="8" step="2" value="2" {{ $useTabs ? 'disabled' : '' }}>
            </div>

            <div class="mb-3">
                <label class="form-label">Converted JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $jsonOutput }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
