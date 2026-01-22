<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Play;
use App\Models\Player;


#[Title("Yahtzee Play")]
class PlayGame extends Component
{
    public int $playId;
    public array $players = [];

    public function mount()
    {
        // sessionからデータを受け取る
        $this->playId = session('play_id');
        $this->players = session('players');

        if (!$this->playId || empty($this->players)) {
            return redirect()->route('play.create');
        }
    }

    public function render()
    {
        return view('livewire.play-game', ['players' => $this->players]);
    }
}
