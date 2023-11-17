<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGardenSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->id === $this->route('garden')->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'garden_id' => ['nullable', 'exists:gardens,id'],
            'saved_with' => ['required', 'string', 'max:255'],
            'data' => ['required', 'array'],
            'autosave' => ['nullable', 'boolean'],
        ];
    }
}
