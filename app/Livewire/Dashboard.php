<?php

namespace App\Livewire;

use App\Models\Subuser;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

#[Title("ホーム")]
class Dashboard extends Component
{
    public int $playCount;
    public int $highestScore;
    public int $registeredMembers;
    public int $registeredGroups;

    public function mount()
    {
        $playerId = auth()->user()->player->id;

        $this->playCount = Score::where('player_id', $playerId)->count();
        $this->highestScore = Score::where('player_id', $playerId)->max('total') ?? 0;
        $this->registeredMembers = Subuser::where('user_id', auth()->id())->count();
    }



    public function render()
    {
        return view('livewire.dashboard');
    }
};
