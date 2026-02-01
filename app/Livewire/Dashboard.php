<?php

namespace App\Livewire;

use App\Models\Subuser;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

#[Title("ダッシュボード")]
class Dashboard extends Component
{
    public int $playCount;
    public int $highestScore;
    public int $registeredMembers;
    public int $registeredGroups;

    public function mount()
    {
        $this->playCount = 12; // Example value
        $this->highestScore = 567; // Example value
        $this->registeredMembers = 90; // Example value
        $this->registeredGroups = 3; // Example value
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
};
