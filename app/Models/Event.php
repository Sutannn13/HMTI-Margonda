<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'location',
        'start_date',
        'end_date',
        'max_participants',
        'poster_path',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'max_participants' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Event $event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) . '-' . Str::random(5);
            }
        });
    }

    /* ---------- Relationships ---------- */

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_registrations')
            ->withPivot('attendance_status', 'certificate_generated', 'registered_at')
            ->withTimestamps();
    }

    /* ---------- Helpers ---------- */

    public function isFull(): bool
    {
        if (is_null($this->max_participants)) {
            return false;
        }
        return $this->registrations()->count() >= $this->max_participants;
    }

    public function attendeesCount(): int
    {
        return $this->registrations()->where('attendance_status', 'attended')->count();
    }

    public function getPosterUrlAttribute(): ?string
    {
        return $this->poster_path ? asset('storage/' . $this->poster_path) : null;
    }
}
