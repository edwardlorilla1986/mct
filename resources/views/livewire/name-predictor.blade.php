<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Nationality Predictor</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Enter a Name:</label>
                <input type="text" class="form-control" id="name" wire:model="name" placeholder="e.g., Nathaniel">
            </div>

            <button class="btn btn-success w-100" wire:click="predictNationality">Predict Nationality</button>

            @if (!empty($predictions))
                <div class="mt-4">
                    <h5>Prediction Results:</h5>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Country</th>
                                <th>Probability (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($predictions as $prediction)
                                <tr>
                                    <td>
                                        <img src="https://flagcdn.com/w40/{{ strtolower($prediction['country_id']) }}.png" 
                                             alt="{{ $prediction['country_id'] }}" width="30">
                                        {{ $prediction['country_id'] }}
                                    </td>
                                    <td>{{ round($prediction['probability'] * 100, 2) }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Alert Message -->
    <script>
        window.addEventListener('show-alert', event => {
            alert(event.detail.message);
        });
    </script>
</div>
