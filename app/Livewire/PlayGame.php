<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Score;
use Illuminate\Support\Facades\DB;


#[Title("Yahtzee Play")]
class PlayGame extends Component
{
    public int $playId;
    public array $playerArray = [];

    public array $validationResult = [];
    public ?string $errorMsg = null;

    public array $scoreArray = [];


    public function mount()
    {
        // sessionからデータを受け取る
        $this->playId = session('play.id');
        $this->playerArray = session('players');

        if (!$this->playId || empty($this->playerArray)) {
            return redirect()->route('play.create');
        }

    }


    /*
    保存ボタンクリックでcheckBeforeSaveメソッドが実行
    */

    public function checkBeforeSave()
    {
        $this->dispatch('request-validation');
    }

    #[On('send-validation-result')]
    public function collectValidationResult($playerId, $errorMessage)
    {
        $this->validationResult[$playerId] = $errorMessage;

        // 全player分のvalidationResultが揃っていれば（player数＆IDが同じか）errorOrSaveを実行
        if(count($this->validationResult) === count($this->playerArray) && $this->isSameId('validationResult')) {
            $this->errorOrSave();
        } else if (count($this->validationResult) > count($this->playerArray)) {
            // もしvalidationResultの数が多ければ不正アクセスとみなし、エラー表示
            $this->dispatch('show-error', error: 'プレーヤー重複エラーが発生しました。もう一度やり直してください。');
            $this->validationResult = [];
        }
    }

    public function isSameId($arrayName) : bool
    {
        // validationResultに全playerのidが存在するか確認
        foreach ($this->playerArray as $player) {
            if (!array_key_exists($player['id'], $this->$arrayName)) {
                // playerIdが合っていなければfalseを返す
                $this->dispatch('show-error', error: 'プレーヤーidエラーが発生しました。もう一度やり直してください。');
                return false;
            }
        }
        return true;
    }

    public function errorOrSave()
    {
        // バリデーションエラーがあればエラー表示のイベントを発火
        if(!$this->canSave()) {
            $this->dispatch('show-error', error: $this->errorMsg);
            $this->validationResult = [];
            return;
        }

        // バリデーションエラーがなければ各プレイヤーのスコアをリクエスト
        $this->dispatch('request-player-score');
        $this->validationResult = [];

    }

    public function canSave() : bool
    {
        foreach ($this->validationResult as $error) {
            if ($error !== null) {
                $this->errorMsg = $error;
                return false;
            }
        }

        return true;
    }

    #[On('send-player-score')]
    public function collectPlayerScore($playId, $playerId, $playerScore)
    {
        if ($playId !== $this->playId) {
            $this->dispatch('show-error', error: 'playidエラーが発生しました。もう一度やり直してください。');
            return;
        }

        $this->scoreArray[$playerId] = [
            'play_id' => $playId,
            'player_id' => $playerId,
            'score' => $playerScore,
        ];

        // 全player分のscoreArrayが揃っていれば（player数＆IDが同じか）errorOrSaveを実行
        if(count($this->scoreArray) === count($this->playerArray) && $this->isSameId('scoreArray')) {
            $this->save();
        } else if (count($this->scoreArray) > count($this->playerArray)) {
            // もしscoreArrayの数が多ければ不正アクセスとみなし、エラー表示
            $this->dispatch('show-error', error: 'プレーヤー重複エラーが発生しました。もう一度やり直してください。');
            $this->scoreArray = [];
        }
    }

    public function save()
    {
        try {
            DB::transaction(function () {
                foreach ($this->scoreArray as $player) {
                    Score::updateOrCreate(
                        [
                            'play_id' => $player['play_id'],
                            'player_id' => $player['player_id'],
                        ],
                        [
                            'ones' => $player['score']['ones'],
                            'twos' => $player['score']['twos'],
                            'threes' => $player['score']['threes'],
                            'fours' => $player['score']['fours']  ,
                            'fives' => $player['score']['fives']  ,
                            'sixes' => $player['score']['sixes']  ,
                            'three_kind' => $player['score']['threeKind'] ,
                            'four_kind' => $player['score']['fourKind'],
                            'full_house' => $player['score']['fullHouse'] ,
                            'small_straight' => $player['score']['smallStraight'] ,
                            'large_straight' => $player['score']['largeStraight'] ,
                            'yahtzee' => $player['score']['yahtzee']  ,
                            'chance' => $player['score']['chance'],
                            'yahtzee_bonus' => $player['score']['yahtzeeBonus'],
                        ],
                    );
                }
            });

            $this->scoreArray = [];
            return redirect()->route('dashboard')->with('success', 'スコアを保存しました');

        } catch (\Throwable $e) {
            logger()->error($e);
            $this->dispatch('show-error', error: '保存中にエラーが発生しました');
            $this->scoreArray = [];
        }
    }

    public function render()
    {
        return view('livewire.play-game');
    }
}
