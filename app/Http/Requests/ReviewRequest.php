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
            'note' => ['required', 'numeric', 'min:1', 'max:5'],
            'movie.id' => ['required', 'integer'],
            'movie.title' => ['required', 'string'],
            'movie.mediaType' => ['required', 'string'],
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
