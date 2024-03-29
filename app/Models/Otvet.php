<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otvet extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer_text',
        'points'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
