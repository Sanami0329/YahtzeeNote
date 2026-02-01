<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;


#[Title("Yahtzee Play")]
class PlayGame extends Component
{
    public int $playId;
    public array $players = [];

    public array $validationResult = [];
    public ?string $errorMsg = null;

    public array $savedPlayers = [];


    public function mount()
    {
        // sessionからデータを受け取る
        $this->playId = session('play_id');
        $this->players = session('players');

        if (!$this->playId || empty($this->players)) {
            return redirect()->route('play.create');
        }

    }


    /*
     save() →　validation-resultを受け取り実行する
    */

    protected $listeners = [
        'send-validation-result' => 'validationResultUpdate',
        'saved-score' => 'redirectIfAllSaved',
    ];

    public function validationResultUpdate($playerId, $errorMessage)
    {
        $this->validationResult[$playerId] = $errorMessage;

        // 全player分のvalidationResultが揃ったらtrySaveを実行
        if (count($this->validationResult) === count($this->players)) {
            $this->trySave();
        }
    }

    public function trySave()
    {
        if (!$this->canSave()) {
            $this->dispatch('show-validation-error', error: $this->errorMsg);
            $this->validationResult = [];
            return;
        }

        $this->dispatch('save-player-score');
        $this->validationResult = [];
    }

        private function canSave(): bool
    {
        foreach ($this->validationResult as $error) {
            if ($error !== null) {
                $this->errorMsg = $error;
                return false;
            }
        }

        return true;
    }

    public function redirectIfAllSaved($playerId)
    {
        $this->savedPlayers[$playerId] = true;

        $allSaved = true;

        foreach ($this->players as $player) {
            // savedPlayersのキーに全playerのidが存在するか確認
            if (!array_key_exists($player['id'], $this->savedPlayers)) {
                $allSaved = false;
                break;
            }
        }

        if ($allSaved) {
            return redirect()->route('dashboard')->with('success', 'スコアを保存しました');
        }
    }


    public function save()
    {
        $this->dispatch('request-validation');
    }

    public function render()
    {
        return view('livewire.play-game');
    }
}
