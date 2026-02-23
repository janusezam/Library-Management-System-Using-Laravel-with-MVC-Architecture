<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:students,id'],
            'due_date' => ['required', 'date', 'after:today'],
            'books' => ['required', 'array', 'min:1'],
            'books.*' => ['exists:books,id'],
        ];
    }
}
