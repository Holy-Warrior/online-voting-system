<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'voting_open',
    ];

    protected function casts(): array
    {
        return [
            'voting_open' => 'boolean',
        ];
    }

    /**
     * There is only ever one settings row. Fetch it, creating it
     * with sensible defaults the first time it's needed.
     */
    public static function current(): self
    {
        return static::query()->firstOrCreate([], ['voting_open' => true]);
    }

    public static function isVotingOpen(): bool
    {
        return (bool) static::current()->voting_open;
    }
}
