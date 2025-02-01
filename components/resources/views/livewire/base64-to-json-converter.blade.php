<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4>Base64 to JSON Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="base64Input" class="form-label">Enter Base64-encoded JSON:</label>
                <textarea id="base64Input" wire:model="base64Input" class="form-control" rows="5" placeholder="ewogInBsYW5ldCIgOiAiZWFydGgiLAogInNpemUiIDogIjFrbSIsCiAibWFzcyIgOiAiMWtnIiwKICJ0aW1lIiA6ICIxc2Vjb25kIgp9"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Decoded JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $jsonOutput }}</pre>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
            </div>
        </div>
    </div>
</div>
