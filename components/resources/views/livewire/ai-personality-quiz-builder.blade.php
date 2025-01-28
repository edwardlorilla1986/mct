<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Personality Quiz Builder</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateQuiz">
                    <div class="mb-3">
                        <label for="quizTopic" class="form-label">Quiz Topic</label>
                        <input type="text" id="quizTopic" class="form-control" wire:model="quizTopic" placeholder="Enter the quiz topic">
                        @error('quizTopic') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="questionCount" class="form-label">Number of Questions</label>
                        <input type="number" id="questionCount" class="form-control" wire:model="questionCount" placeholder="5" min="1" max="20">
                        @error('questionCount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Quiz</span>
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

        @if($quiz)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generated Quiz</h5>
                    <ol>
                        @foreach($quiz as $item)
                            <li class="mb-3">
                                <strong>{{ $item['question'] }}</strong>
                                <ul>
                                    @foreach($item['options'] as $option)
                                        <li>{{ $option }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        @else
            <div class="text-muted">Enter a quiz topic and click "Generate Quiz" to see the results.</div>
        @endif
    </div>
</div>
