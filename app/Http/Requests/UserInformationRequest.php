<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInformationRequest extends FormRequest
{
  public function rules(): array
  {
    return [
        'first_name' => 'required|string|max:254|min:3',
        'last_name' => 'required|string|max:254|min:3',
        'email' => ['required', 'string', 'email', 'max:254', 'min:3', 'unique:users,email,' . auth()->id()],
        'username' => ['required', 'string', 'max:254', 'min:3', 'unique:users,username,' . auth()->id()],
    ];
  }

  public function authorize(): bool
  {
    return true;
  }
}
