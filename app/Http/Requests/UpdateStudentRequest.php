<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'string', Rule::unique('students')->ignore($this->student)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('students')->ignore($this->student)],
            'course' => ['required', 'string', 'max:255'],
            'year_level' => ['required', 'integer', 'min:1', 'max:4'],
            'contact_number' => ['nullable', 'string', 'max:20'],
        ];
    }
}
