<div class="container mt-4">
    <h2 class="text-center">Convert JSON to Form Data</h2>
    
    <div class="card shadow-sm p-4">
        <div class="form-group">
            <label for="jsonInput"><b>Enter JSON:</b></label>
            <textarea wire:model="jsonInput" id="jsonInput" class="form-control" rows="5" placeholder='{"key":"value"}'></textarea>
        </div>

        <button class="btn btn-primary mt-2" wire:click="convertJsonToFormData">Convert</button>

        <div class="mt-3">
            <label for="formDataOutput"><b>Generated Form Data:</b></label>
            <textarea id="formDataOutput" class="form-control" rows="3" readonly>{{ $formDataOutput }}</textarea>

            <button class="btn btn-success mt-2" onclick="copyToClipboard()">Copy to Clipboard</button>
        </div>
    </div>
</div>

<script>
    function copyToClipboard() {
        let text = document.getElementById("formDataOutput");
        text.select();
        document.execCommand("copy");
        alert("Copied to clipboard!");
    }
</script>
