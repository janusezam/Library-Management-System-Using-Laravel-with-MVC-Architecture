<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'string', 'unique:students,student_id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:students,email'],
            'course' => ['required', 'string', 'max:255'],
            'year_level' => ['required', 'integer', 'min:1', 'max:4'],
            'contact_number' => ['nullable', 'string', 'max:20'],
        ];
    }
}
