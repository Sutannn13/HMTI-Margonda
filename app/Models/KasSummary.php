<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasSummary extends Model
{
    protected $fillable = [
        'month',
        'year',
        'total_expected',
        'total_collected',
        'total_fines',
        'total_balance',
        'notes',
        'disposition',
    ];

    protected function casts(): array
    {
        return [
            'total_expected' => 'integer',
            'total_collected' => 'integer',
            'total_fines' => 'integer',
            'total_balance' => 'integer',
        ];
    }

    public function getPeriodLabelAttribute(): string
    {
        $months = KasPayment::MONTH_NAMES;
        return ($months[$this->month] ?? '') . ' ' . $this->year;
    }

    public function getFormattedCollectedAttribute(): string
    {
        return 'Rp ' . number_format($this->total_collected, 0, ',', '.');
    }

    public function getFormattedBalanceAttribute(): string
    {
        return 'Rp ' . number_format($this->total_balance, 0, ',', '.');
    }

    public function getDispositionLabelAttribute(): string
    {
        return match ($this->disposition) {
            'returned' => 'Dikembalikan',
            'planning' => 'Untuk Planning Bersama',
            default => 'Belum Ditentukan',
        };
    }

    /**
     * Recalculate summary from payments.
     */
    public static function recalculate(int $month, int $year): self
    {
        $payments = KasPayment::where('month', $month)->where('year', $year)->get();

        $summary = self::updateOrCreate(
            ['month' => $month, 'year' => $year],
            [
                'total_expected' => $payments->count() * KasPayment::MONTHLY_AMOUNT,
                'total_collected' => $payments->where('is_paid', true)->sum('total_amount'),
                'total_fines' => $payments->where('is_late', true)->where('is_paid', true)->sum('fine_amount'),
                'total_balance' => $payments->where('is_paid', true)->sum('total_amount'),
            ]
        );

        return $summary;
    }
}
