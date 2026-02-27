<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollaborationRequest extends Model
{
    protected $fillable = [
        'name', 'organization', 'email', 'phone',
        'proposal_type', 'message',
        'status', 'admin_notes', 'handled_by', 'handled_at',
    ];

    protected function casts(): array
    {
        return [
            'handled_at' => 'datetime',
        ];
    }

    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public static function proposalTypeLabel(string $type): string
    {
        return match ($type) {
            'event_sponsor'  => 'Sponsor Acara',
            'workshop'       => 'Workshop / Seminar',
            'recruitment'    => 'Rekrutmen Anggota',
            'research'       => 'Kolaborasi Riset',
            'social_project' => 'Proyek Sosial',
            default          => 'Lainnya',
        };
    }

    public function proposalLabel(): string
    {
        return self::proposalTypeLabel($this->proposal_type);
    }
}
