<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'user_id', 'subuser_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subuser()
    {
        return $this->belongsTo(Subuser::class);
    }

    // playsとplayersは多対多
    public function plays()
    {
        return $this->belongsToMany(Play::class)->withTimestamps();
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
