<?php

namespace App\Livewire\Plays;

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

        foreach ($this->playerArray as $i => $player) {
            $this->playerArray[$i]['playerNumber'] = $i;
        }
    }

    public function quitGame()
    {
        session()->forget(['play.id', 'players']);
        return redirect()->route('dashboard');
    }

    public function resetScores()
    {
        $this->dispatch('request-reset-score');
    }


    /*
    保存ボタンクリックでcheckBeforeSaveメソッドが実行
    */

    public function checkBeforeSave()
    {
        $this->dispatch('request-validation');
    }

    #[On('send-validation-result')]
    public function collectValidationResult($playerData, $errorMessage)
    {
        $this->validationResult[] = ['playerData' => $playerData, 'msg' => $errorMessage];

        // 全player分のvalidationResultが揃っていれば（player数＆IDが同じか）errorOrSaveを実行
        if (count($this->validationResult) === count($this->playerArray) && $this->isSameId($this->validationResult)) {
            $this->errorOrSave();
        } else if (count($this->validationResult) > count($this->playerArray)) {
            // もしvalidationResultの数が多ければ不正アクセスとみなし、エラー表示
            $this->dispatch('show-error', error: 'プレイヤー重複エラーが発生しました。もう一度やり直してください。');
            $this->validationResult = [];
        }
    }

    private function isSameId($array): bool
    {
        if ($this->playerArray != array_column($array, 'playerData')) {
            // playerDataの中身が合っていなければエラーを表示
            $this->dispatch('show-error', error: '異なるプレイヤーが検出されました。もう一度やり直してください。');
            return false;
        }
        return true;
    }

    private function errorOrSave()
    {
        // バリデーションエラーがあればエラー表示のイベントを発火
        if (!$this->canSave()) {
            $this->dispatch('show-error', error: $this->errorMsg);
            $this->validationResult = [];
            return;
        }

        // バリデーションエラーがなければ各プレイヤーのスコアをリクエスト
        $this->dispatch('request-player-score');
        $this->validationResult = [];
    }

    private function canSave(): bool
    {
        foreach ($this->validationResult as $playerError) {
            if ($playerError['msg'] !== null) {
                $this->errorMsg = $playerError['msg'];
                return false;
            }
        }

        return true;
    }

    #[On('send-player-score')]
    public function collectPlayerScore($playId, $playerData, $playerScore)
    {
        if ($playId !== $this->playId) {
            $this->dispatch('show-error', error: 'playidエラーが発生しました。もう一度やり直してください。');
            return;
        }

        $this->scoreArray[$playerData['playerNumber']] = [
            'playId' => $playId,
            'playerData' => $playerData,
            'score' => $playerScore,
        ];

        // 全player分のscoreArrayが揃っていれば（player数＆IDが同じか）errorOrSaveを実行
        if (count($this->scoreArray) === count($this->playerArray) && $this->isSameId($this->scoreArray)) {
            $this->dispatch('confirm-save');
        } else if (count($this->scoreArray) > count($this->playerArray)) {
            // もしscoreArrayの数が多ければ不正アクセスとみなし、エラー表示
            $this->dispatch('show-error', error: 'プレイヤー重複エラーが発生しました。もう一度やり直してください。');
            $this->scoreArray = [];
        }
    }

    #[On('request-save')]
    public function save()
    {
        try {
            DB::transaction(function () {
                foreach ($this->scoreArray as $player) {
                    // logger()->info('Saving score', $player);

                    if ($player['playerData']['playerIsRegistered']) {
                        Score::updateOrCreate(
                            [
                                'play_id' => $player['playId'],
                                'player_id' => $player['playerData']['playerId'],
                            ],
                            [
                                'ones' => $player['score']['ones'],
                                'twos' => $player['score']['twos'],
                                'threes' => $player['score']['threes'],
                                'fours' => $player['score']['fours'],
                                'fives' => $player['score']['fives'],
                                'sixes' => $player['score']['sixes'],
                                'three_kind' => $player['score']['threeKind'],
                                'four_kind' => $player['score']['fourKind'],
                                'full_house' => $player['score']['fullHouse'],
                                'small_straight' => $player['score']['smallStraight'],
                                'large_straight' => $player['score']['largeStraight'],
                                'yahtzee' => $player['score']['yahtzee'],
                                'chance' => $player['score']['chance'],
                                'yahtzee_bonus' => $player['score']['yahtzeeBonus'],
                                'total' => $player['score']['total'],
                            ],
                        );
                    }
                }
            });

            $this->scoreArray = [];
            session()->forget(['play.id', 'players']);
            return redirect()->route('dashboard')->with('success', 'スコアを保存しました');
        } catch (\Throwable $e) {
            logger()->error($e->getMessage());
            logger()->error($e->getTraceAsString());
            $this->dispatch('show-error', error: '保存中にエラーが発生しました');
            $this->scoreArray = [];
        }
    }

    public function render()
    {
        return view('livewire.plays.play-game');
    }
}
