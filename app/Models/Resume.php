<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
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

    protected $fillable = [
        'user_id',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function ($resume) {
            $firstName = $resume->data['personalInfo'][0]['firstName'] ?? '';
            $lastName = $resume->data['personalInfo'][0]['lastName'] ?? '';

            $name = trim("$firstName $lastName") ?: 'resume';

            $resume->slug = Str::slug($name) . '-' . uniqid();
        });
    }
   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
