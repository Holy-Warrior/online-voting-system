<?php

namespace App\Models;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
    ];

    // A candidate has many votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
