<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'email',
        'course',
        'year_level',
        'contact_number',
    ];

    public function borrowTransactions(): HasMany
    {
        return $this->hasMany(BorrowTransaction::class, 'student_id');
    }

    public function activeBorrows(): Collection
    {
        return $this->borrowTransactions()
            ->whereIn('status', ['active', 'partially_returned'])
            ->get();
    }
}
