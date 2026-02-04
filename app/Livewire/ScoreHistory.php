<?php

namespace App\Livewire;

use Livewire\Component;
use \App\Models\Score;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
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

    #[Computed]
    public function scoreHistories()
    {
        return Score::with('play.scores.player')
            ->where('player_id', auth()->id())
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(50);
    }


    public function render()
    {
        return view('livewire.score-history');
    }
}
