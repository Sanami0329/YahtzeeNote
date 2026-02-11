<?php

namespace App\Livewire;

use App\Models\Subuser;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use App\Models\Score;
use Illuminate\Support\Facades\DB;
use App\Models\Player;

#[Title("ホーム")]
class Dashboard extends Component
{
    public int $playCount;
    public int $highestScore;
    public int $registeredMembers;
    public int $registeredGroups;

    public function mount()
    {
        $player = Player::where('user_id', auth()->id())
            ->whereNull('subuser_id')
            ->first();

        if ($player) {
            $this->playCount = Score::where('player_id', $player->id)->count();
            $this->highestScore = Score::where('player_id', $player->id)->max('total') ?? 0;
        } else {
            // 万が一プレイヤーがいない場合の初期値
            $this->playCount = 0;
            $this->highestScore = 0;
        }

        $this->registeredMembers = Subuser::where('user_id', auth()->id())->count();
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
};
