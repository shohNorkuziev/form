<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'theme',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    public function page()
    {
        return $this->hasMany(Page::class);
    }
    public function questionnaire()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
