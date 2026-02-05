<?php

namespace App\Livewire;

use Livewire\Component;
use \App\Models\Score;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[title("スコア履歴")]
class ScoreHistory extends Component
{
    use WithPagination;

    public $sortBy = 'total';
    public $sortDirection = 'desc';

    public function sort($column) {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'desc';
        }
    }


    public function render()
    {
        $scoreHistories = Score::with('play.scores.player')
            ->where('player_id', auth()->id())
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(20);

        return view('livewire.score-history', [
            'scoreHistories' => $scoreHistories
        ]);
    }
}
