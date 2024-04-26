<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class TodoStatusCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return match ($value) {
            0 => 'pending',
            1 => 'in progress',
            2 => 'blocked',
            default => 'unknown',
        };
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return match ($value) {
            'pending' => 0,
            'in progress' => 1,
            'blocked' => 2,
            default => 99,
        };

    }
}
