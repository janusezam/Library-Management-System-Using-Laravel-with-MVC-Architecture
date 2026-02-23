<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BorrowTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'borrow_date',
        'due_date',
        'returned_date',
        'status',
        'total_fine',
    ];

    protected function casts(): array
    {
        return [
            'borrow_date' => 'date',
            'due_date' => 'date',
            'returned_date' => 'date',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function borrowItems(): HasMany
    {
        return $this->hasMany(BorrowItem::class, 'borrow_transaction_id');
    }

    public function activeItems(): Collection
    {
        return $this->borrowItems()
            ->where('status', 'borrowed')
            ->get();
    }

    public function computeTotalFine(): float
    {
        return $this->borrowItems()
            ->sum('fine');
    }
}
