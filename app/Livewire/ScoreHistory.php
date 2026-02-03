<?php

namespace App\Livewire;

use Livewire\Component;
use \Livewire\WithPagination;
use \App\Models\Score;

class ScoreHistory extends Component
{
    public $sortBy = 'score';
    public $sortDirection = 'asc';

    public function sort($column) {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[\Livewire\Attributes\Computed]
    public function histories()
    {
        // need to rewrite
        // return Score::query()
        //     ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
        //     ->paginate(10);
    }


    public function render()
    {
        return view('livewire.score-history');
    }
}
