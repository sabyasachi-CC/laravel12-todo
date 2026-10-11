<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $id = $this->route('user')?->id;

        return ['first_name' => ['required', 'string', 'max:100'], 'last_name' => ['required', 'string', 'max:100'], 'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$id], 'phone' => ['nullable', 'string', 'max:30'], 'address' => ['nullable', 'string', 'max:5000'], 'status' => ['required', 'boolean'], 'type' => ['required', 'in:user,admin']];
    }
}
