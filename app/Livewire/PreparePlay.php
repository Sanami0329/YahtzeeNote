<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Play;
use App\Models\Player;
use Illuminate\Support\Facades\DB;


class PreparePlay extends Component
{
    public function mount()
    {
        $subusers = session('subusers_data');

        if (!$subusers) {
            return redirect()->route('play.create');
        }

        // 新しいplayを発行
        $play = Play::create([
            'user_id' => auth()->id(),
        ]);

        $players = [];

        // Playersからuserを取得
        $userPlayer = Player::where([
            'user_id' => auth()->id(),
            'subuser_id' => null,
        ])->first();

        $players[] = [
            'id' => $userPlayer->id,
            'name' => $userPlayer->name,
        ];

        // sessionに保存されたsubusersを取り出してplayersに追加
        foreach ($subusers as $subuser) {
            $player = Player::where('subuser_id', $subuser['id'])->first();

            if ($player) {
                $players[] = [
                    'id' => $player->id,
                    'name' => $player->name,
                ];
            }
        }

        session([
            'play_id' => $play->id,
            'players' => $players,
        ]);

        return redirect()->route('play.game');
    }

    public function render()
    {
        return null; // view不要
    }
}
