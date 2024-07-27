<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'note' => (int) $this->note,
        ]);
    }

    public function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'max:255', 'min:3'],
            'note' => ['required', 'integer', 'min:1', 'max:5'],
            'movie_id' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'note.required' => 'Please select a note.',
            'note.min' => 'Please select a note.',
            'note.max' => 'Please select a note between 1 and 5.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
