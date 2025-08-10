<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'details',
    ];

    // A candidate has many votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Public URL for the candidate's uploaded photo, or null if
     * none was uploaded (views fall back to an initials avatar).
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::get(
            fn () => $this->image ? asset('storage/'.$this->image) : null
        );
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
