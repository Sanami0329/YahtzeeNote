<?php

namespace App\Livewire;

use App\Models\Subuser;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

#[Title("ホーム")]
class Home extends Component
{
    public int $playCount;
    public int $highestScore;
    public int $registeredMembers;
    public int $registeredGroups;

    public function mount()
    {
        $this->playCount = Score::where('player_id', auth()->id())->count();
        $this->highestScore = Score::where('player_id', auth()->id())->max('total') ?? 0;
        $this->registeredMembers = Subuser::where('user_id', auth()->id())->count();
        $this->registeredGroups = 3; // Example value
    }



    public function render()
    {
        return view('livewire.home');
    }
};
