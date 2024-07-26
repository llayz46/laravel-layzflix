<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileAvatarRequest extends FormRequest
{
  public function rules(): array
  {
    return [
        'avatar' => ['required', 'image', 'max:10000', 'mimes:jpeg,png,svg'],
    ];
  }

  public function authorize(): bool
  {
    return true;
  }
}
