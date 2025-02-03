<div class="container mt-4">
    <h2 class="text-center">Convert Form Data to JSON</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form wire:submit.prevent="convertToJson">
                <div class="mb-3">
                    <button type="button" class="btn btn-success" wire:click="addField">
                        + Add Field
                    </button>
                </div>

                @foreach($formData as $index => $field)
                    <div class="row mb-2">
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Key" wire:model="formData.{{ $index }}.key">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Value" wire:model="formData.{{ $index }}.value">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger" wire:click="removeField({{ $index }})">X</button>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Convert to JSON</button>
                </div>
            </form>
        </div>
    </div>

    @if($jsonOutput)
        <div class="mt-4">
            <h4>JSON Output</h4>
            <pre class="border p-3 bg-light">{{ $jsonOutput }}</pre>
            <button class="btn btn-secondary" onclick="copyToClipboard()">Copy to Clipboard</button>
        </div>
    @endif
</div>

<script>
    function copyToClipboard() {
        let text = document.querySelector("pre").innerText;
        navigator.clipboard.writeText(text).then(() => {
            alert("Copied to clipboard!");
        });
    }
</script>
