<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property array<array-key, mixed>|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereUserId($value)
 * @mixin \Eloquent
 */
class Resume extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'data',
    ];

    /**
     * The attributes that should be cast.
     * This tells Laravel to automatically handle JSON encoding/decoding.
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get the user that owns the resume.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
