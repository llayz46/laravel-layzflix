<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'first_name' => ['required', 'string', 'min:3', 'max:254'],
      'last_name' => ['required', 'string', 'min:3', 'max:254'],
      'username' => ['required', 'string', 'min:3', 'max:254', 'unique:users'],
      'email' => ['required', 'email', 'max:254', 'unique:users'],
      'email_verified_at' => ['nullable', 'date'],
      'password' => ['required', 'confirmed', Password::defaults()],
      'remember_token' => ['nullable'],
    ];
  }

  public function authorize(): bool
  {
    return true;
  }
}
