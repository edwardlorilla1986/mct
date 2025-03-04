<div>
    <div class="container py-5">
        <h1 class="text-center mb-4">AI-Powered Headline Generator</h1>
        <p class="text-center">Generate unique and catchy titles for your blog posts, articles, or videos using AI.</p>

        <!-- Input Form -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form wire:submit.prevent="generateHeadline">
                    <div class="mb-3">
                        <label for="keywords" class="form-label">Enter Keywords</label>
                        <input type="text" id="keywords" class="form-control" placeholder="e.g., AI tools, productivity, blogging tips" wire:model="keywords">
                    </div>

                    <div class="mb-3">
                        <label for="tone" class="form-label">Select Tone/Style</label>
                        <select id="tone" class="form-select" wire:model="tone">
                            <option value="catchy">Catchy</option>
                            <option value="informative">Informative</option>
                            <option value="creative">Creative</option>
                            <option value="controversial">Controversial</option>
                            <option value="listicle">Listicle</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Generate Headline</button>
                </form>
            </div>
        </div>

        <!-- Results -->
        @if ($headlines)
            <div class="mt-5">
                <h3 class="text-center">Suggested Headlines</h3>
                <ul class="list-group list-group-flush">
                    @foreach ($headlines as $headline)
                        <li class="list-group-item">{{ $headline }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
