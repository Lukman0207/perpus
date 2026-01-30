<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'stok',
        'deskripsi',
        'isbn',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'stok' => 'integer',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function getAvailableStockAttribute(): int
    {
        $borrowed = $this->transactions()
            ->where('type', 'peminjaman')
            ->where('status', 'dipinjam')
            ->count();
        
        return max(0, $this->stok - $borrowed);
    }
}
