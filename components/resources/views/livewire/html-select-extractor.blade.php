<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">HTML Select Extractor</h4>
        </div>
        <div class="card-body">
            <p>Paste your HTML select code below to extract and convert its options.</p>

            <div class="mb-3">
                <label class="form-label">HTML Input:</label>
                <textarea class="form-control" rows="6" wire:model="htmlInput"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Select Output Format:</label>
                <select class="form-control w-50" wire:model="outputFormat">
                    <option value="json">JSON</option>
                    <option value="jsonline">JSONLine</option>
                    <option value="yaml">YAML</option>
                    <option value="sql">SQL</option>
                    <option value="csv">CSV</option>
                    <option value="html">HTML</option>
                    <option value="php_array">PHP Array</option>
                    <option value="js_object">JS Object</option>
                    <option value="py_dict">Python Dictionary</option>
                </select>
            </div>

            <button class="btn btn-success mt-2" wire:click="extractOptions">Convert</button>

            <div class="mt-4">
                <h5>Extracted Output:</h5>
                <pre class="bg-light p-3 border rounded text-dark" id="output-box">{{ $output }}</pre>
            </div>

            <button class="btn btn-primary mt-2" wire:click="copyToClipboard">Copy to Clipboard</button>
        </div>
    </div>
</div>

<script>
    window.addEventListener('copy-output', event => {
        navigator.clipboard.writeText(event.detail.output).then(() => {
            alert('Output copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    });
</script>
