<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrow_transaction_id',
        'book_id',
        'returned_date',
        'fine',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'returned_date' => 'date',
        ];
    }

    public function borrowTransaction(): BelongsTo
    {
        return $this->belongsTo(BorrowTransaction::class, 'borrow_transaction_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function computeFine(): float
    {
        $dueDate = $this->borrowTransaction->due_date->startOfDay();
        $compareDate = ($this->returned_date ?? Carbon::today())->startOfDay();

        // If returned on or before due date, no fine
        if ($compareDate->lte($dueDate)) {
            return 0;
        }

        // Calculate overdue days using the difference
        $diff = $compareDate->diff($dueDate);
        $overdaysDays = (int) $diff->days;

        return $overdaysDays * 10;
    }
}
