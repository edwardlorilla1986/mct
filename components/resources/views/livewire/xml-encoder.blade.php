<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">XML Encoder</h4>
        </div>
        <div class="card-body">
            
            <!-- Input XML Text -->
            <div class="mb-3">
                <label for="inputText" class="form-label">Input XML:</label>
                <textarea class="form-control" rows="5" wire:model="inputText"></textarea>
            </div>

            <!-- Encoding Mode Selection -->
            <div class="mb-3">
                <label class="form-label">Encoding Mode:</label>
                <select class="form-control" wire:model="encodingMode">
                    <option value="special_chars">Special Chars</option>
                    <option value="non_ascii">Non ASCII</option>
                    <option value="non_ascii_printable">Non ASCII Printable</option>
                    <option value="extensive">Extensive</option>
                </select>
            </div>

            <!-- Numeric Encoding Toggle -->
            <div class="mb-3">
                <label class="form-label">Numeric Encoding:</label>
                <input type="checkbox" wire:model="numericMode"> Enable Hex/Decimal Numeric Encoding
            </div>

            <button class="btn btn-success" wire:click="encodeXml">Encode XML</button>

            <!-- Output XML Text -->
            @if ($outputText)
                <div class="mt-4">
                    <h5>Encoded XML:</h5>
                    <textarea class="form-control" rows="5" readonly>{{ $outputText }}</textarea>
                    <button class="btn btn-secondary mt-2" onclick="copyToClipboard()">Copy to Clipboard</button>
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    function copyToClipboard() {
        let textArea = document.querySelector('textarea[readonly]');
        textArea.select();
        document.execCommand('copy');
        alert('Copied to clipboard!');
    }
</script>
