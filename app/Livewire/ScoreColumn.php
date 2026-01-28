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
    public array $upperScores = ['ones', 'twos', 'threes', 'fours', 'fives', 'sixes'];

    // Lower Scores
    public ?int $threeKind = null;
    public ?int $fourKind = null;
    public ?int $fullHouse = null;
    public ?int $smallStraight = null;
    public ?int $largeStraight = null;
    public ?int $yahtzee = null;
    public ?int $chance = null;
    public array $lowerScores = ['threeKind', 'fourKind', 'fullHouse', 'smallStraight', 'largeStraight', 'yahtzee', 'chance'];

    public int $yahtzeeBonus = 0;
    public array $yahtzeeBonusItems = [false, false, false, false, false]; //yahtzeeBonusのcheckbox

    public array $scoreItems = [];

    public array $scoreConfig = [
        'ones'   => ['label' => 'Ones', 'min' => 0, 'max' => 5, 'step' => 1],
        'twos'  => ['label' => 'Twos', 'min' => 0, 'max' => 10, 'step' => 2],
        'threes' => ['label' => 'Threes', 'min' => 0, 'max' => 15, 'step' => 3],
        'fours' => ['label' => 'Fours', 'min' => 0, 'max' => 20, 'step' => 4],
        'fives' => ['label' => 'Fives', 'min' => 0, 'max' => 25, 'step' => 5],
        'sixes' => ['label' => 'Sixes', 'min' => 0, 'max' => 30, 'step' => 6],
        'threeKind' => ['label' => 'Three of a Kind', 'min' => 0, 'max' => 30, 'step' => 1],
        'fourKind'  => ['label' => 'Four of a Kind', 'min' => 0, 'max' => 30, 'step' => 1],
        'fullHouse' => ['label' => 'Full House', 'min' => 0, 'max' => 25, 'step' => 25],
        'smallStraight' => ['label' => 'Small Straight', 'min' => 0, 'max' => 30, 'step' => 30],
        'largeStraight' => ['label' => 'Large Straight', 'min' => 0, 'max' => 40, 'step' => 40],
        'yahtzee' => ['label' => "Yahtzee", 'min' => 0, 'max' => 50, 'step' => 50],
        'chance'  => ['label' => 'Chance', 'min' => 0, 'max' => 30, 'step' => 1],
        'yahtzeeBonus' => ['label' => 'Yahtzee Bonus', 'min' => 0, 'max' => 500, 'step' => 100],
    ];

    // playerのscoreが全部入力されているか確認した結果が入る変数
    public bool $isComplete = false;


    /*
    以下メソッド
    */
    public function mount(int $playId, int $playerId, string $playerName)
    {
        // playIdがセッションに存在しない場合はリダイレクト
        if (!session()->has('play_id') || session('play_id') != $playId) {
            return redirect()->route('play.create');
        }

        $this->playId = $playId;
        $this->playerId = $playerId;
        $this->playerName = $playerName;

        $this->scoreItems = array_merge($this->upperScores, $this->lowerScores);

        $this->scoreConfig = collect($this->scoreConfig)
            ->map(function ($config) {
                return [
                    ...$config,
                    'in' => range(
                        $config['min'],
                        $config['max'],
                        $config['step']
                    ),
                ];
            })
            ->toArray();
    }

    // decrement button calc
    public function decrement($field)
    {
        $currentValue = $this->$field;

        if ($currentValue === null) {
            $this->$field = 0;
        } elseif ($currentValue > 0) {
            $this->$field = max(0, $currentValue - $this->scoreConfig[$field]['step']);
        }
    }

    // increment button clac
    public function increment($field)
    {
        $currentValue = $this->$field ?? 0;
        $max = $this->scoreConfig[$field]['max'];
        $step = $this->scoreConfig[$field]['step'];

        if ($field === 'threeKind' || $field === 'fourKind' || $field === 'chance') {
            if ($currentValue < $max) {
                $this->$field = min($currentValue + $step * 5, $max);
            }
        } else {
            if ($currentValue < $max) {
                $this->$field = min($currentValue + $step, $max);
            }
        }
    }

    /*
    score calc
    */

    // upperscore total
    public function getUpperScore()
    {
        $total = 0;

        foreach($this->upperScores as $field) {
            $total += $this->$field ?? 0;
        }
        return $total;
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
        $total = 0;
        foreach($this->lowerScores as $field) {
            $total += $this->$field ?? 0;
        }
        return $total + $this->getYahtzeeBonus();
    }

    // grand total
    public function getGrandTotal()
    {
        return $this->getUpperTotal() + $this->getLowerTotal();
    }


    /*
    Validation
    */
    protected function rules()
    {
        // nullble, 半角数字, 整数, min, max
        return collect($this->scoreConfig)
            ->flatMap(fn ($config, $configField) => [
                $configField => array_filter([
                    'required',
                    'integer',
                    'min:' . $config['min'],
                    'max:' . $config['max'],
                    'in:' . implode(',', $config['in']),
                ]),
            ])->toArray();
    }

    protected function messages()
    {
        $messages = [];

        foreach ($this->scoreConfig as $field => $config) {
            $messages["{$field}.required"] = "全プレーヤーのスコアを入力してください";
            $messages["{$field}.integer"] = "スコアは整数で入力してください";
            $messages["{$field}.min"] = "{$config['label']}には{$config['min']}～{$config['max']}までの数字を入力してください";
            $messages["{$field}.max"] = "{$config['label']}には{$config['min']}～{$config['max']}までの数字を入力してください";

            if (count($this->scoreConfig[$field]['in']) > 2) {
                $inValues = implode('、', $this->scoreConfig[$field]['in']);
                $messages["{$field}.in"] = "{$config['label']}には{$inValues}のいずれかを入力してください";
            } elseif (count($this->scoreConfig[$field]['in']) === 2) {
                $inValues = implode('または', $this->scoreConfig[$field]['in']);
                $messages["{$field}.in"] = "{$config['label']}には{$inValues}を入力してください";
            }
        }

        return $messages;
    }


    protected $listeners = [
        'request-validation' => 'validateScores',
        'save-player-score' => 'save',
    ];

    // リスナーでrequest-validationを受け取って、このplayerのスコアのバリデーション実行
    public function validateScores()
    {
        try {
            $this->validate();
            $this->dispatch('send-validation-result', playerId: $this->playerId, errorMessage: null);
        } catch (ValidationException $e) {
            // バリデーションエラーがあれば、エラーメッセージも含め親のplaygameへdispatch
            $this->dispatch('send-validation-result', playerId: $this->playerId, errorMessage: $e->validator->errors()->first());
        }
    }

    public function save()
    {
        Score::updateOrCreate(
            [
                'play_id' => $this->playId,
                'player_id' => $this->playerId,
            ],
            [
                'ones' => $this->ones,
                'twos' => $this->twos,
                'threes' => $this->threes,
                'fours' => $this->fours,
                'fives' => $this->fives,
                'sixes' => $this->sixes,
                'three_kind' => $this->threeKind,
                'four_kind' => $this->fourKind,
                'full_house' => $this->fullHouse,
                'small_straight' => $this->smallStraight,
                'large_straight' => $this->largeStraight,
                'yahtzee' => $this->yahtzee,
                'chance' => $this->chance,
                'yahtzee_bonus' => $this->yahtzeeBonus,
            ]
        );

        $this->dispatch('saved-score', playerId: $this->playerId);
    }

    public function render()
    {
        return view('livewire.score-column');
    }
}
