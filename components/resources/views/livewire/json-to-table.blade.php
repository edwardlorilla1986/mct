<div class="container mt-4">
    <h2 class="mb-3 text-primary">JSON to HTML Table Converter</h2>

    <!-- JSON Input -->
    <div class="mb-3">
        <textarea wire:model="jsonInput" class="form-control" rows="5" placeholder="Enter JSON here..."></textarea>
    </div>

    <!-- Display Error Message -->
    @if ($errorMessage)
        <div class="alert alert-danger">{{ $errorMessage }}</div>
    @endif

    <!-- Display JSON Table if Data Exists -->
    @if (!empty($tableData) && isset($tableData[0]) && is_array($tableData[0]))
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        @foreach (array_keys($tableData[0]) as $key)
                            <th>{{ ucfirst($key) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tableData as $row)
                        <tr>
                            @foreach ($row as $key => $cell)
                                <td>{{ is_array($cell) ? json_encode($cell) : $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
