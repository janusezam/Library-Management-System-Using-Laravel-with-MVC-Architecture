<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'title',
        'genre',
        'published_year',
        'total_copies',
        'available_copies',
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    public function borrowItems(): HasMany
    {
        return $this->hasMany(BorrowItem::class, 'book_id');
    }

    public function isAvailable(): bool
    {
        return $this->available_copies > 0;
    }
}
