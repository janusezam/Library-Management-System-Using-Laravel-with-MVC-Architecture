<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'isbn' => ['required', 'string', Rule::unique('books')->ignore($this->book)],
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['nullable', 'string', 'max:100'],
            'published_year' => ['nullable', 'digits:4', 'integer'],
            'total_copies' => ['required', 'integer', 'min:1'],
            'authors' => ['required', 'array', 'min:1'],
            'authors.*' => ['exists:authors,id'],
        ];
    }
}
