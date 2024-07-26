<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPublicProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'bio' => ['nullable', 'string', 'max:254', 'min:3'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
