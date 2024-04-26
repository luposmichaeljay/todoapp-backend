<?php

namespace App\Models;

use App\Casts\TodoStatusCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'status',
        'priority',
        'due_date',
        'date_completed',
        'archived',
    ];

    protected $casts = [
        'status' => TodoStatusCast::class,
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, TodoTag::class);
    }
}
