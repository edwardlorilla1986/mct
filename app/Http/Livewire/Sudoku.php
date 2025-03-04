<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sudoku extends Component
{
    public $board = [];
    public $solution = [];
    public $difficulty = 1; // Default difficulty level (1-9)
    public $message = '';

    public function mount()
    {
        $this->generateSudoku();
    }

    public function generateSudoku()
    {
        $this->message = '';
        
        // Generate a complete Sudoku board
        $this->solution = $this->generateFullSudoku();

        // Create a puzzle by removing numbers based on difficulty
        $this->board = $this->removeNumbers($this->solution, $this->difficulty);
    }

    public function updateCell($row, $col, $value)
    {
        if (!is_numeric($value) || $value < 1 || $value > 9) {
            $this->message = 'Invalid input. Enter numbers between 1-9.';
            return;
        }

        if ($this->solution[$row][$col] == $value) {
            $this->board[$row][$col] = $value;
            $this->message = '';

            if ($this->isCompleted()) {
                $this->message = '🎉 Congratulations! You solved the Sudoku!';
            }
        } else {
            $this->message = '❌ Incorrect! Try again.';
        }
    }

    public function isCompleted()
    {
        foreach ($this->board as $row) {
            if (in_array(0, $row)) {
                return false;
            }
        }
        return true;
    }

    public function generateFullSudoku()
    {
        $board = array_fill(0, 9, array_fill(0, 9, 0));

        if ($this->fillSudoku($board)) {
            return $board;
        }

        return [];
    }

    private function fillSudoku(&$board)
    {
        for ($row = 0; $row < 9; $row++) {
            for ($col = 0; $col < 9; $col++) {
                if ($board[$row][$col] == 0) {
                    $numbers = range(1, 9);
                    shuffle($numbers);

                    foreach ($numbers as $num) {
                        if ($this->isValid($board, $row, $col, $num)) {
                            $board[$row][$col] = $num;

                            if ($this->fillSudoku($board)) {
                                return true;
                            }

                            $board[$row][$col] = 0;
                        }
                    }
                    return false;
                }
            }
        }
        return true;
    }

    private function isValid($board, $row, $col, $num)
    {
        for ($i = 0; $i < 9; $i++) {
            if ($board[$row][$i] == $num || $board[$i][$col] == $num) {
                return false;
            }
        }

        $startRow = floor($row / 3) * 3;
        $startCol = floor($col / 3) * 3;
        
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($board[$startRow + $i][$startCol + $j] == $num) {
                    return false;
                }
            }
        }

        return true;
    }

    private function removeNumbers($board, $difficulty)
    {
        $cellsToRemove = $difficulty * 7;

        while ($cellsToRemove > 0) {
            $row = rand(0, 8);
            $col = rand(0, 8);

            if ($board[$row][$col] != 0) {
                $board[$row][$col] = 0;
                $cellsToRemove--;
            }
        }

        return $board;
    }

    public function render()
    {
        return view('livewire.sudoku');
    }
}
