<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Play Sudoku</h4>
        </div>
        <div class="card-body text-center">
            <div class="mb-3">
                <label for="difficulty" class="form-label">Select Difficulty:</label>
                <select class="form-control w-25 d-inline-block" wire:model="difficulty">
                    @for($i = 1; $i <= 9; $i++)
                        <option value="{{ $i }}">Level {{ $i }}</option>
                    @endfor
                </select>
                <button class="btn btn-success mt-2" wire:click="generateSudoku">New Game</button>
            </div>

            @if ($message)
                <div class="alert {{ strpos($message, 'Congratulations') !== false ? 'alert-success' : 'alert-danger' }}">
                    {{ $message }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered sudoku-table mx-auto">
                    @foreach($board as $rowIdx => $row)
                        <tr>
                            @foreach($row as $colIdx => $cell)
                                <td class="{{ ($rowIdx % 3 == 2) ? 'border-bottom' : '' }} {{ ($colIdx % 3 == 2) ? 'border-right' : '' }}">
                                    @if($cell == 0)
                                        <input type="text" class="form-control text-center sudoku-input"
                                         maxlength="1"

       wire:key="sudoku-cell-{{ $rowIdx }}-{{ $colIdx }}"
                                        
                                               maxlength="1"
                                               wire:change="updateCell({{ $rowIdx }}, {{ $colIdx }}, $event.target.value)">
                                    @else
                                        <span class="pre-filled">{{ $cell }}</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<style>
input, textarea {
    color: black !important; /* Ensures the text is black */
    background-color: white !important; /* Ensures the background is white */
}
    .sudoku-table {
        width: 500px;
        border-collapse: collapse;
    }
.sudoku-input, .pre-filled {
    color: black !important;
}
    .sudoku-table td {
        width: 500px;
        height: 70px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        border: 1px solid black;
    }

    .sudoku-input {
        color: black !important;
    background-color: white !important;
    caret-color: black; /* Ensures the cursor is visible */
        width: 100%;
        height: 100%;
        border: none;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        outline: none;
    }

    .pre-filled {
        font-size: 18px;
        font-weight: bold;
        color: #000;
    }

    .border-bottom {
        border-bottom: 3px solid black !important;
    }

    .border-right {
        border-right: 3px solid black !important;
    }
</style>
