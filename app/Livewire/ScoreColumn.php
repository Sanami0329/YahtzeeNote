<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Score;

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
    public array $yahtzeeBonusItems = [false, false, false, false, false]; //yahtzee-bonusのcheckbox

    public function mount(int $playId, int $playerId, string $playerName)
    {
        // playIdがセッションに存在しない場合はリダイレクト
        if (!session()->has('play_id') || session('play_id') != $playId) {
            return redirect()->route('play.create');
        }

        $this->playId = $playId;
        $this->playerId = $playerId;
        $this->playerName = $playerName;
    }

    // increment button clac
    public function increment($field, $step, $max)
    {
        $currentValue = $this->$field ?? 0;
        if ($currentValue < $max) {
            $this->$field = min($currentValue + $step, $max);
        }
    }

    // decrement button calc
    public function decrement($field, $step)
    {
        $currentValue = $this->$field;

        if ($currentValue === null) {
            $this->$field = 0;
        } elseif ($currentValue > 0) {
            $this->$field = max(0, $currentValue - $step);
        }
    }

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


    public function save()
    {
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
