<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">JSON to Markdown Table Converter</h4>
        </div>
        <div class="card-body">

            <!-- Toolbar Buttons -->
            <div class="mb-3">
                <button class="btn btn-secondary" wire:click="clearAll">New</button>

                <!-- File Upload -->
                <input type="file" id="fileInput" class="d-none" wire:model="uploadedFile" wire:change="loadFromFile">
                <button class="btn btn-secondary" onclick="document.getElementById('fileInput').click()">Open</button>

                <button class="btn btn-secondary" wire:click="undo">Undo</button>
                <button class="btn btn-secondary" wire:click="redo">Redo</button>
            </div>

            <!-- Input JSON Data -->
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON Data:</label>
                <textarea class="form-control" rows="6" wire:model="jsonInput"></textarea>
            </div>

            <!-- Alignment Selection -->
            <div class="mb-3">
                <label class="form-label">Table Alignment:</label>
                <select class="form-control" wire:model="alignment">
                    <option value="left">Left</option>
                    <option value="center">Center</option>
                    <option value="right">Right</option>
                </select>
            </div>

            <button class="btn btn-success" wire:click="convertToMarkdown">Convert to Markdown</button>

            <!-- Display Error Message -->
            @if ($errorMessage)
                <div class="alert alert-danger mt-3">{{ $errorMessage }}</div>
            @endif

            <!-- Output Markdown Table -->
            @if ($markdownOutput)
                <div class="mt-4">
                    <h5>Markdown Table:</h5>
                    <textarea class="form-control" rows="6" readonly>{{ $markdownOutput }}</textarea>

                    <div class="mt-3">
                        <button class="btn btn-secondary" onclick="copyToClipboard()">Copy</button>
                        <button class="btn btn-secondary" onclick="printMarkdown()">Print</button>
                        <button class="btn btn-secondary" onclick="downloadMarkdown()">Download</button>
                    </div>
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

    function printMarkdown() {
        let markdownText = document.querySelector('textarea[readonly]').value;
        let printWindow = window.open('', '', 'width=600,height=400');
        printWindow.document.write('<pre>' + markdownText + '</pre>');
        printWindow.document.close();
        printWindow.print();
    }

    function downloadMarkdown() {
        let markdownText = document.querySelector('textarea[readonly]').value;
        let blob = new Blob([markdownText], { type: 'text/markdown' });
        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'table.md';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
