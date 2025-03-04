<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Timer Card -->
            <div class="card text-center shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4>Pomodoro Timer</h4>
                </div>
                <div class="card-body">
                    <!-- Timer Display -->
                    <h1 class="display-3 font-weight-bold my-4" id="timer">{{ $timer }}</h1>

                    <!-- Controls -->
                    <div class="d-flex justify-content-center gap-2">
                        <button wire:click="startTimer" class="btn btn-success btn-lg">Start</button>
                        <button wire:click="pauseTimer" class="btn btn-warning btn-lg">Pause</button>
                        <button wire:click="resetTimer" class="btn btn-danger btn-lg">Reset</button>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Pomodoros Completed: <strong>{{ $completedPomodoros }}/{{ $totalPomodoros }}</strong>
                </div>
            </div>

            <!-- Task Management -->
            <div class="card mt-4 shadow-lg">
                <div class="card-header bg-secondary text-white">
                    <h5>Tasks</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <input type="checkbox" wire:click="toggleTaskCompletion({{ $task['id'] }})" {{ $task['completed'] ? 'checked' : '' }}>
                                    <span class="{{ $task['completed'] ? 'text-decoration-line-through' : '' }}">{{ $task['name'] }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Add New Task -->
                    <div class="input-group mt-3">
                        <input type="text" wire:model="newTask" class="form-control" placeholder="Add a new task">
                        <button wire:click="addTask" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('livewire:load', function () {
    let interval;
    window.addEventListener('start-timer', event => {
        clearInterval(interval);
        let duration = event.detail.duration;
        interval = setInterval(() => {
            let minutes = Math.floor(duration / 60);
            let seconds = duration % 60;
            minutes = minutes < 10 ? `0${minutes}` : minutes;
            seconds = seconds < 10 ? `0${seconds}` : seconds;
            Livewire.emit('timerTick', `${minutes}:${seconds}`);
            if (duration <= 0) {
                clearInterval(interval);
                alert("Time's up! Take a break.");
            }
            duration--;
        }, 1000);
    });

    window.addEventListener('pause-timer', () => {
        clearInterval(interval);
    });

    window.addEventListener('reset-timer', () => {
        clearInterval(interval);
    });
});
</script>
