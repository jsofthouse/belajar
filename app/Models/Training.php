<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'held_at',
        'quota',
        'price',
    ];

    protected $casts = [
        'held_at' => 'datetime',
    ];

    public function participants()
    {
        return $this->belongsToMany(Participant::class)->withTimestamps();
    }
}
