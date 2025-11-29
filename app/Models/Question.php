<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable =
    ['section_id', 'question_text', 'question_type'];

    //Eloquent Relationship
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
