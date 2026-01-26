<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;


#[Title("Yahtzee Play")]
class PlayGame extends Component
{
    public int $playId;
    public array $players = [];

    public array $playerErrors = [];

    public ?string $errorMsg = null;

    public int $playerErrorCount = 0;

    public function mount()
    {
        // sessionからデータを受け取る
        $this->playId = session('play_id');
        $this->players = session('players');

        if (!$this->playId || empty($this->players)) {
            return redirect()->route('play.create');
        }

        // 全playerのstatusを初期化
        foreach ($this->players as $player) {
            $this->playerErrors[$player['id']] = null;
        }
    }

    /*
     validationを受け取り実行する
    */

    public function playerErrorsUpdate($playerId, $errorMessage)
    {
        $this->playerErrors[$playerId] = $errorMessage;

        $this->playerErrorCount++;

        // 全player分のplayerErrorsが揃ったら判定
        if ($this->playerErrorCount === count($this->players)) {
            $this->playerErrorCount = 0;

            // 全playerのvalidationが通ったら保存イベントを発火
            if (!$this->canSave()) {
                $this->dispatch('show-validation-error', error: $this->errorMsg);
                return;
            }

            $this->dispatch('save-player-score');
        }
    }

    private function canSave(): bool
    {
        foreach ($this->playerErrors as $error) {
            if ($error !== null) {
                $this->errorMsg = $error;
                return false;
            }
        }

        return true;
    }


    protected $listeners = [
        'send-validation-result' => 'playerErrorsUpdate',
    ];


    public function save()
    {
        $this->dispatch('request-validation');
    }

    public function render()
    {
        return view('livewire.play-game', ['players' => $this->players]);
    }
}
