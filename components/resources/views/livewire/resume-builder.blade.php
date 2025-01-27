<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Resume Builder</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateResume">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" wire:model="name" placeholder="Enter your full name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" wire:model="email" placeholder="Enter your email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="experience" class="form-label">Work Experience</label>
                        <textarea id="experience" class="form-control" wire:model="experience" rows="4" placeholder="Detail your work experience"></textarea>
                        @error('experience') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                        <textarea id="skills" class="form-control" wire:model="skills" rows="3" placeholder="List your skills"></textarea>
                        @error('skills') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="education" class="form-label">Education</label>
                        <textarea id="education" class="form-control" wire:model="education" rows="3" placeholder="Detail your educational background"></textarea>
                        @error('education') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Resume</span>
                        <span wire:loading>Generating...</span>
                    </button>
                </form>
            </div>
        </div>

        @if($errorMessage)
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        @if($generatedResume)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generated Resume</h5>
                    <div style="white-space: pre-wrap; font-family: monospace;">
                        {{ $generatedResume }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-muted">Fill out the details above and click "Generate Resume" to see your AI-powered resume.</div>
        @endif
    </div>
</div>
