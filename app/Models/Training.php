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

    public function scopeSearch($query, ?string $searchTerm)
    {
        return $query->when($searchTerm, function ($q, $searchTerm) {
            $q->where(function ($sub) use ($searchTerm) {
                $sub->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('location', 'like', "%{$searchTerm}%");
            });
        });
    }

    public function scopeUpcoming($query)
    {
        return $query->where('held_at', '>', now());
    }

    public function scopePast($query)
    {
        return $query->where('held_at', '<=', now());
    }

    public function scopeAtLocation($query, ?string $location)
    {
        return $query->when($location, fn($q) => $q->where('location', $location));
    }

    public function scopeStatus($query, ?string $status)
    {
        return $query->when($status, function ($q) use ($status) {
            if ($status === 'upcoming') {
                $q->upcoming();
            } elseif ($status === 'past') {
                $q->past();
            }
        });
    }
}
