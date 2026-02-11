<?php

namespace App\Livewire\Plays;

use Livewire\Component;
use App\Models\Play;
use App\Models\Player;
use Illuminate\Support\Facades\DB;


class PreparePlay extends Component
{
    public function mount()
    {
        // createplayでsessionに保存した内容を取り出し、playgameのための情報を再度sessionに保存
        $createdPlayers = session('created.players.data');

        if (!session()->has('created.players.data')) {
            return redirect()->route('play.create');
        }

        // 新しいplayを発行
        $play = Play::create([
            'user_id' => auth()->id(),
        ]);


        $playerArray = [];

        // Playersからuserを取得してplayerArrayに格納
        $userPlayer = Player::where([
            'user_id' => auth()->id(),
            'subuser_id' => null,
        ])->first();

        if (!$userPlayer) {
            // ログイン中のユーザー名を使ってその場で作る
            $userPlayer = Player::create([
                'user_id' => auth()->id(),
                'name' => auth()->user()->name,
            ]);
        }

        $playerArray[] = [
            'playerIsRegistered' => true,
            'playerId' => $userPlayer->id,
            'playerName' => $userPlayer->name,
        ];


        // sessionに保存されたcreatedPlayersを取り出してplayersに追加
        foreach ($createdPlayers as $createdPlayer) {
            // createdPlayerがsubuserに登録されていれば、登録メンバーとしてプレイ
            if ($createdPlayer['playerIsRegistered']) {
                $subuserPlayer = Player::where('subuser_id', $createdPlayer['playerId'])->first();

                $playerArray[] = [
                    'playerIsRegistered' => true,
                    'playerId' => $subuserPlayer->id,
                    'playerName' => $subuserPlayer->name,
                ];
            } else {
                // それ以外はsessionでのゲストメンバー
                $playerArray[] = [
                    'playerIsRegistered' => false,
                    'playerId' => null,
                    'playerName' => $createdPlayer['playerName'],
                ];
            }
        }

        session([
            'play.id' => $play->id,
            'players' => $playerArray,
        ]);

        session()->forget('created.players.data');

        return redirect()->route('play.game');
    }

    public function render()
    {
        return null; // view不要
    }
}
