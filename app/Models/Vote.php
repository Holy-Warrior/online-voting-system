<?php

namespace App\Models;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'voter_id',
        'candidate_id',
    ];

    // A vote belongs to a voter (User)
    public function voter()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }

    // A vote belongs to a candidate
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
