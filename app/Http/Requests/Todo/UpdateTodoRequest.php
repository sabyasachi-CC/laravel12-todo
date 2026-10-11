<?php

namespace App\Http\Requests\Todo;

use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
{
    public function authorize(): bool
    {
        $todo = $this->route('todo');

        return $todo instanceof Todo ? $this->user()->can('update', $todo) : false;
    }

    public function rules(): array
    {
        return ['title' => ['required', 'string', 'max:255'], 'description' => ['nullable', 'string'], 'status' => ['sometimes', 'boolean']];
    }
}
