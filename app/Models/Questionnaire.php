<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
}
