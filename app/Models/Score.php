<?php

namespace App\Models;

use App\Livewire\Play;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    public const SCORE_ITEMS = [
        'ones',
        'twos',
        'threes',
        'fours',
        'fives',
        'sixes',
        'three_kind',
        'four_kind',
        'full_house',
        'small_straight',
        'large_straight',
        'yahtzee',
        'chance',
        'yahtzee_bonus',
    ];

    protected $fillable = [
        'player_id',
        'play_id',
        ...self::SCORE_ITEMS, //SCORE_ITEMSを参照
    ];

    public function play()
    {
        return $this->belongsTo(Play::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
