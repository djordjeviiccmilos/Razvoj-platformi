<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Questions extends Model
{
    protected $fillable = [
        'questionText',
        'type',
        'options',
        'correctAnswer',
        'user_id',
        'banned'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
