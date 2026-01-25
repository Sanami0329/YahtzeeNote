<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Score;
use Illuminate\Validation\ValidationException;

class ScoreColumn extends Component
{
    // play-game.bladeで呼び出される際に渡されるidやname→mountで初期化
    public int $playId;
    public int $playerId;
    public string $playerName;

    // Upper Scores
    public ?int $ones = null;
    public ?int $twos = null;
    public ?int $threes = null;
    public ?int $fours = null;
    public ?int $fives = null;
    public ?int $sixes = null;

    // Lower Scores
    public ?int $threeKind = null;
    public ?int $fourKind = null;
    public ?int $fullHouse = null;
    public ?int $smallStraight = null;
    public ?int $largeStraight = null;
    public ?int $yahtzee = null;
    public ?int $chance = null;

    public int $yahtzeeBonus = 0;
    public array $yahtzeeBonusItems = [false, false, false, false, false]; //yahtzeeBonusのcheckbox

    public array $scoreItems = [];

    public array $scoreConfig = [
        'ones'   => ['min' => 0, 'max' => 5, 'step' => 1],
        'twos'  => ['min' => 0, 'max' => 10, 'step' => 2],
        'threes' => ['min' => 0, 'max' => 15, 'step' => 3],
        'fours' => ['min' => 0, 'max' => 20, 'step' => 4],
        'fives' => ['min' => 0, 'max' => 25, 'step' => 5],
        'sixes' => ['min' => 0, 'max' => 30, 'step' => 6],
        'threeKind' => ['min' => 0, 'max' => 30, 'step' => 1],
        'fourKind'  => ['min' => 0, 'max' => 30, 'step' => 1],
        'fullHouse' => ['min' => 0, 'max' => 25, 'in:0,25', 'step' => 25],
        'smallStraight' => ['min' => 0, 'max' => 30, 'in:0,30', 'step' => 30],
        'largeStraight' => ['min' => 0, 'max' => 40, 'in:0,40', 'step' => 40],
        'yahtzee' => ['min' => 0, 'max' => 50, 'in:0,50', 'step' => 50],
        'chance'  => ['min' => 0, 'max' => 30, 'step' => 1],
    ];

    // playerのscoreが全部入力されているか確認した結果が入る変数
    public bool $isComplete = false;



    public function mount(int $playId, int $playerId, string $playerName)
    {
        // playIdがセッションに存在しない場合はリダイレクト
        if (!session()->has('play_id') || session('play_id') != $playId) {
            return redirect()->route('play.create');
        }

        $this->playId = $playId;
        $this->playerId = $playerId;
        $this->playerName = $playerName;

        $this->scoreItems = [
            'ones',
            'twos',
            'threes',
            'fours',
            'fives',
            'sixes',
            'threeKind',
            'fourKind',
            'fullHouse',
            'smallStraight',
            'largeStraight',
            'yahtzee',
            'chance',
        ];
    }

    // increment button clac
    public function increment($field)
    {
        $config = $this->scoreConfig[$field];

        $currentValue = $this->$field ?? 0;

        if ($field === 'threeKind' || $field === 'fourKind' || $field === 'chance') {
            if ($currentValue < $config['max']) {
                $this->$field = min($currentValue + $config['step'] * 5, $config['max']);
            }
        } else {
            if ($currentValue < $config['max']) {
                $this->$field = min($currentValue + $config['step'], $config['max']);
            }
        }
    }

    // decrement button calc
    public function decrement($field)
    {
        $config = $this->scoreConfig[$field];

        $currentValue = $this->$field;

        if ($currentValue === null) {
            $this->$field = 0;
        } elseif ($currentValue > 0) {
            $this->$field = max(0, $currentValue - $config['step']);
        }
    }

    /*
    score calc
    */

    // upperscore total
    public function getUpperScore()
    {
        return ($this->ones ?? 0) +
            ($this->twos ?? 0) +
            ($this->threes ?? 0) +
            ($this->fours ?? 0) +
            ($this->fives ?? 0) +
            ($this->sixes ?? 0);
    }

    // bonus calc
    public function getBonus()
    {
        return $this->getUpperScore() >= 63 ? 35 : 0;
    }

    // upper total
    public function getUpperTotal()
    {
        return $this->getUpperScore() + $this->getBonus();
    }

    //  yahtzee bonus calc
    public function getYahtzeeBonus()
    {
        $this->yahtzeeBonus = count(array_filter($this->yahtzeeBonusItems)) * 100;
        return $this->yahtzeeBonus;
    }

    //lower total
    public function getLowerTotal()
    {
        return ($this->threeKind ?? 0) +
            ($this->fourKind ?? 0) +
            ($this->fullHouse ?? 0) +
            ($this->smallStraight ?? 0) +
            ($this->largeStraight ?? 0) +
            ($this->yahtzee ?? 0) +
            ($this->chance ?? 0) +
            $this->yahtzeeBonus;
    }

    // grand total
    public function getGrandTotal()
    {
        return $this->getUpperTotal() + $this->getLowerTotal();
    }


    /*
    全playerが全fieldにscoreを入れたか確認
    */

    // 1.scoreの全itemがnullじゃないか確認
    private function checkAllFilled(): bool
    {
        foreach ($this->scoreItems as $scoreItem) {
            if ($this->$scoreItem === null) {
                return false;
            }
        }
        return true;
    }

    // 2.親のPlayGameのscoreStatusUpdateにplayerIdとcompleteStatusを送る
    public function dispatchStatus()
    {
        $this->isComplete = $this->checkAllFilled();

        $this->dispatch('score-status-update', $this->playerId, $this->isComplete);
    }

    protected $listeners = [
        'request-status' => 'dispatchStatus',
        'save-player-score' => 'save',
    ];


    /*
    バリデーションルール
    */
    protected function rules()
    {
        // nullble, 半角数字, 整数, min, max
        return collect($this->scoreConfig)
            ->mapWithKeys(fn ($config, $configField) => [
                $configField => [
                    'nullable',
                    'regex:/^\d+$/',
                    'integer',
                    'min:' . $config['min'],
                    'max:' . $config['max'],
                    // $this->stepRule($config['step']),
                ],
            ])->toArray();
    }

    public function save()
    {
        // スコア全体をバリデーション
        try {
            $this->validate();
        } catch (ValidationException $e) {
            // バリデーションエラーがあれば表示
            $this->dispatch('show-validation-error', errors: $e->errors());
            return;
        }

        Score::create([
            'play_id' => $this->playId,
            'player_id' => $this->playerId,
            'ones' => $this->ones ?? 0,
            'twos' => $this->twos ?? 0,
            'threes' => $this->threes ?? 0,
            'fours' => $this->fours ?? 0,
            'fives' => $this->fives ?? 0,
            'sixes' => $this->sixes ?? 0,
            'three_kind' => $this->threeKind ?? 0,
            'four_kind' => $this->fourKind ?? 0,
            'full_house' => $this->fullHouse ?? 0,
            'small_straight' => $this->smallStraight ?? 0,
            'large_straight' => $this->largeStraight ?? 0,
            'yahtzee' => $this->yahtzee ?? 0,
            'chance' => $this->chance ?? 0,
            'yahtzee_bonus' => $this->yahtzeeBonus,
        ]);
    }

    public function render()
    {
        return view('livewire.score-column');
    }
}
