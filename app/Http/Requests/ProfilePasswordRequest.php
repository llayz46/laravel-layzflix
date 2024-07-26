<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfilePasswordRequest extends FormRequest
{
  public function rules(): array
  {
    return [
        'current_password' => ['required', 'current_password'],
        'new_password' => ['required', 'min:8', 'max:128', 'same:new_password_confirm', 'different:current_password', Password::defaults()],
    ];
  }

  public function authorize(): bool
  {
    return true;
  }
}
