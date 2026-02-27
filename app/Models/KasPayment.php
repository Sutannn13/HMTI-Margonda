<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KasPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_member_id',
        'month',
        'year',
        'amount',
        'is_paid',
        'paid_at',
        'is_late',
        'fine_amount',
        'total_amount',
        'notes',
        'marked_by',
    ];

    protected function casts(): array
    {
        return [
            'is_paid' => 'boolean',
            'is_late' => 'boolean',
            'paid_at' => 'datetime',
            'amount' => 'integer',
            'fine_amount' => 'integer',
            'total_amount' => 'integer',
        ];
    }

    /* ---------- Constants ---------- */

    public const MONTHLY_AMOUNT = 25000;  // Rp 25.000
    public const LATE_FINE = 15000;       // Rp 15.000

    public const MONTH_NAMES = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
        4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    /* ---------- Relationships ---------- */

    public function member(): BelongsTo
    {
        return $this->belongsTo(OrganizationMember::class, 'organization_member_id');
    }

    public function markedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marked_by');
    }

    /* ---------- Helpers ---------- */

    public function getMonthNameAttribute(): string
    {
        return self::MONTH_NAMES[$this->month] ?? '';
    }

    public function getPeriodLabelAttribute(): string
    {
        return $this->month_name . ' ' . $this->year;
    }

    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getFormattedFineAttribute(): string
    {
        return 'Rp ' . number_format($this->fine_amount, 0, ',', '.');
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getStatusLabelAttribute(): string
    {
        if ($this->is_paid) {
            return 'Lunas';
        }
        if ($this->is_late) {
            return 'Telat (Kena Denda)';
        }
        return 'Belum Bayar';
    }

    public function getStatusColorAttribute(): string
    {
        if ($this->is_paid) {
            return 'green';
        }
        if ($this->is_late) {
            return 'red';
        }
        return 'yellow';
    }

    /**
     * Check if this payment is late (past the month boundary).
     */
    public static function checkAndApplyFine(self $payment): void
    {
        $now = now();
        $paymentDate = \Carbon\Carbon::create($payment->year, $payment->month, 1);
        $nextMonth = $paymentDate->copy()->addMonth();

        // If current date is past the payment month and not paid
        if ($now->gte($nextMonth) && !$payment->is_paid && !$payment->is_late) {
            $payment->update([
                'is_late' => true,
                'fine_amount' => self::LATE_FINE,
                'total_amount' => $payment->amount + self::LATE_FINE,
            ]);
        }
    }
}
