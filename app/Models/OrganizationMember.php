<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganizationMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nim',
        'phone',
        'email',
        'avatar',
        'division',
        'position',
        'sort_order',
        'status',
    ];

    /* ---------- Constants ---------- */

    public const DIVISIONS = [
        'kwsb' => 'KWSB (Ketua, Wakil, Sekretaris, Bendahara)',
        'kominfo' => 'Kominfo (Komunikasi & Informasi)',
        'litbang' => 'Litbang (Penelitian & Pengembangan)',
        'psdm' => 'PSDM (Pengembangan Sumber Daya Manusia)',
    ];

    public const POSITIONS = [
        'ketua' => 'Ketua',
        'wakil' => 'Wakil Ketua',
        'sekretaris' => 'Sekretaris',
        'bendahara' => 'Bendahara',
        'kadiv' => 'Kepala Divisi',
        'staff' => 'Staff',
    ];

    public const DIVISION_COLORS = [
        'kwsb' => 'blue',
        'kominfo' => 'yellow',
        'litbang' => 'green',
        'psdm' => 'purple',
    ];

    /* ---------- Relationships ---------- */

    public function kasPayments(): HasMany
    {
        return $this->hasMany(KasPayment::class);
    }

    /* ---------- Helpers ---------- */

    public function getDivisionLabelAttribute(): string
    {
        return self::DIVISIONS[$this->division] ?? $this->division;
    }

    public function getPositionLabelAttribute(): string
    {
        return self::POSITIONS[$this->position] ?? $this->position;
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=1a3a6b&color=f5c518&bold=true&size=128';
    }

    /**
     * Get total kas paid this year.
     */
    public function totalKasPaidThisYear(): int
    {
        return $this->kasPayments()
            ->where('year', now()->year)
            ->where('is_paid', true)
            ->sum('total_amount');
    }

    /**
     * Get total outstanding kas this year.
     */
    public function totalKasOutstandingThisYear(): int
    {
        return $this->kasPayments()
            ->where('year', now()->year)
            ->where('is_paid', false)
            ->sum('total_amount');
    }

    /**
     * Check if member has unpaid kas with fines.
     */
    public function hasSanctions(): bool
    {
        return $this->kasPayments()
            ->where('is_paid', false)
            ->where('is_late', true)
            ->exists();
    }
}
