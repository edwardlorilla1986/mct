<div>
    <div class="container mt-5">
        <h2 class="mb-4">Advanced Speed Reading Test</h2>

        @if(!$selectedPassage)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Choose a Passage to Begin</h5>
                    <ul class="list-group">
                        @foreach($passages as $passage)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $passage['title'] }}</span>
                                <button class="btn btn-primary btn-sm" wire:click="startTest({{ $passage['id'] }})">Start</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $selectedPassage['title'] }}</h5>
                    <p>{{ $selectedPassage['content'] }}</p>
                    <button class="btn btn-danger" wire:click="endTest">End Test</button>
                </div>
            </div>
        @endif

        @if($endTime)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Test Results</h5>
                    <p><strong>Reading Speed:</strong> {{ number_format($readingSpeed, 2) }} WPM</p>
                    <p><strong>Comprehension Score:</strong> {{ $comprehensionScore }}%</p>
                </div>
            </div>
        @endif

        @if($selectedPassage && !$endTime)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Comprehension Quiz</h5>
                    <form wire:submit.prevent="endTest">
                        @foreach($questions as $index => $question)
                            <div class="mb-3">
                                <label class="form-label">{{ $question['question'] }}</label>
                                @foreach($question['options'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[{{ $index }}]" wire:model="answers.{{ $index }}" value="{{ $option }}">
                                        <label class="form-check-label">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Submit Answers</button>
                    </form>
                </div>
            </div>
        @endif

        @if($readingHistory)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reading History</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Speed (WPM)</th>
                                <th>Comprehension Score (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($readingHistory as $history)
                                <tr>
                                    <td>{{ $history['date'] }}</td>
                                    <td>{{ number_format($history['speed'], 2) }}</td>
                                    <td>{{ $history['score'] }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
