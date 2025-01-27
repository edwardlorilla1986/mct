<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>GPA Calculator</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="calculateGPA">
                <div class="mb-3">
                    <h5>Courses:</h5>
                    @foreach ($courses as $index => $course)
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <label class="form-label">Grade (0 - 4)</label>
                                <input type="number" step="0.01" class="form-control" wire:model="courses.{{ $index }}.grade" placeholder="Enter grade">
                            </div>
                            <div class="me-3">
                                <label class="form-label">Credit Hours</label>
                                <input type="number" class="form-control" wire:model="courses.{{ $index }}.creditHours" placeholder="Enter credit hours">
                            </div>
                            <button type="button" class="btn btn-danger mt-4" wire:click="removeCourse({{ $index }})">Remove</button>
                        </div>
                    @endforeach
                    <button type="button" class="btn btn-secondary mb-3" wire:click="addCourse">Add Course</button>
                </div>

                <button type="submit" class="btn btn-primary w-100">Calculate GPA</button>
            </form>

            @if (!is_null($finalGPA))
                <div class="alert alert-success mt-4">
                    <h5>Final GPA:</h5>
                    <p><strong>{{ number_format($finalGPA, 2) }}</strong></p>
                </div>
            @endif
        </div>
    </div>
</div>
