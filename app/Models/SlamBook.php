<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlamBook extends Model
{
    protected $table = 'slambooks';

    protected $fillable = [
        'user_id',
        'age',
        'zodiac_sign',
        'in_relationship',
        'dream_job',
        'motto',
        'three_words'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
