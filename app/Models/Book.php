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
        'kategori',
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
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->count();
        
        return max(0, $this->stok - $borrowed);
    }
}
