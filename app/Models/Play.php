<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // playsとplayersは多対多
    public function players()
    {
        return $this->belongsToMany(Player::class)->withTimestamps();
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
