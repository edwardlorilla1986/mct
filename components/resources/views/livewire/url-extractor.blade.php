<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"> URL Extractor</h4>
        </div>
        <div class="card-body">
            <p>Paste your **HTML** or **text** below to extract **URLs** in various formats.</p>

            <div class="mb-3">
                <label class="form-label">HTML Input:</label>
                <textarea class="form-control input-dark" rows="6" wire:model="htmlInput"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Output Format:</label>
                <select class="form-control w-50 input-dark" wire:model="outputFormat">
                    <option value="plaintext">Plain Text</option>
                    <option value="json">JSON</option>
                    <option value="jsonline">JSONLine</option>
                    <option value="xml">XML</option>
                    <option value="yaml">YAML</option>
                    <option value="sql">SQL</option>
                    <option value="csv">CSV</option>
                    <option value="html">HTML</option>
                    <option value="php_array">PHP Array</option>
                    <option value="js_array">JS Array</option>
                </select>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model="extractHref" id="extractHref">
                <label class="form-check-label" for="extractHref">Extract Href</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model="extractPlainText" id="extractPlainText">
                <label class="form-check-label" for="extractPlainText">Extract Plaintext URLs</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model="extractAttributes" id="extractAttributes">
                <label class="form-check-label" for="extractAttributes">Extract from Attributes</label>
            </div>

            <button class="btn btn-success mt-2" wire:click="extractUrls">Extract</button>

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
