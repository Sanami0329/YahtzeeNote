<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;


#[Title("Yahtzee Play")]
class PlayGame extends Component
{
    public int $playId;
    public array $players = [];

    public array $playerStatus = [];
    public ?string $errorMsg = null;

    public function mount()
    {
        // sessionからデータを受け取る
        $this->playId = session('play_id');
        $this->players = session('players');

        if (!$this->playId || empty($this->players)) {
            return redirect()->route('play.create');
        }

        // 全プレーヤーの入力状態を初期化（デフォルトは未入力=false）
        foreach ($this->players as $player) {
            $this->playerStatus[$player['id']] = false;
        }
    }

    /*
    全playerが全fieldにscoreを入れたか確認
    */
    // 3.子のscorecolumnからイベント情報受け取る
    protected $listeners = [
        'score-status-update' => 'scoreStatusUpdate'
    ];

    // 4.受け取ったイベント情報をもとに各playerのstatusを更新
    public function scoreStatusUpdate($playerId, $completeStatus)
    {
        $this->playerStatus[$playerId] = $completeStatus;
    }

    // 5.saveできるかどうか判定 saveできるstatusじゃなければエラーメッセージを出す
    private function canSave(): bool
    {
        // ※in_array:trueで型指定
        if (in_array(false, $this->playerStatus, true)) {
            $this->errorMsg = '全プレーヤーのスコアを入力してください';
            return false;
        }

        $this->errorMsg = null;
        return true;
    }


    public function save()
    {
        $this->dispatch('request-status');

        if (!$this->canSave()) {
            return;
        }
        $this->dispatch('save-player-score');
    }

    public function render()
    {
        return view('livewire.play-game', ['players' => $this->players]);
    }
}
