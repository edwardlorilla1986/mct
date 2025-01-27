<div>
    <div class="container mt-5">
        <h2 class="mb-4">Paraphrasing Tool</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="paraphraseText">
                    <div class="mb-3">
                        <label for="inputText" class="form-label">Enter Text to Paraphrase</label>
                        <textarea id="inputText" class="form-control" wire:model="inputText" rows="5" placeholder="Enter the text you want to paraphrase..."></textarea>
                        @error('inputText') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Paraphrase Text</span>
                        <span wire:loading>Processing...</span>
                    </button>
                </form>
            </div>
        </div>

        @if($errorMessage)
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        @if($paraphrasedText)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Paraphrased Text</h5>
                    <div>{{ $paraphrasedText }}</div>
                </div>
            </div>
        @else
            <div class="text-muted">Enter text above and click "Paraphrase Text" to see the result.</div>
        @endif
    </div>
</div>
