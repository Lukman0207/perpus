<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'type',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
        'keterangan',
        'hari_terlambat',
        'denda',
    ];

    protected const DENDA_PER_HARI = 1000;

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_dikembalikan' => 'date',
        'denda' => 'decimal:0',
    ];

    public static function hitungDenda(int $hariTerlambat): int
    {
        return $hariTerlambat * self::DENDA_PER_HARI;
    }

    /** Untuk tampilan: denda dari DB atau dihitung dari tanggal jika belum ada */
    public function getDisplayDendaAttribute(): float
    {
        if ((float) $this->denda > 0) {
            return (float) $this->denda;
        }
        if (in_array($this->status, ['dikembalikan', 'terlambat']) && $this->tanggal_dikembalikan && $this->tanggal_kembali && $this->tanggal_dikembalikan->gt($this->tanggal_kembali)) {
            $hari = $this->tanggal_dikembalikan->diffInDays($this->tanggal_kembali);
            return (float) self::hitungDenda($hari);
        }
        return 0;
    }

    /** Untuk tampilan: hari terlambat dari DB atau dihitung dari tanggal jika belum ada */
    public function getDisplayHariTerlambatAttribute(): int
    {
        if ((int) $this->hari_terlambat > 0) {
            return (int) $this->hari_terlambat;
        }
        if (in_array($this->status, ['dikembalikan', 'terlambat']) && $this->tanggal_dikembalikan && $this->tanggal_kembali && $this->tanggal_dikembalikan->gt($this->tanggal_kembali)) {
            return (int) $this->tanggal_dikembalikan->diffInDays($this->tanggal_kembali);
        }
        return 0;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
