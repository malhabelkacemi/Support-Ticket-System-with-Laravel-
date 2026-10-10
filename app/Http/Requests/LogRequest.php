<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'user_id' => ['required', 'integer', 'exists:users,id'],
        'ticket_id' => ['nullable', 'integer', 'exists:tickets,id'],
        'log_name' => ['required', 'string', 'max:40'],
        'description' => ['required', 'string', 'min:10', 'max:1000'],
        'properties' => ['nullable', 'array'],
        'properties.*' => ['nullable'],

        // Champs polymorphiques (si vous les utilisez)
        'subject_type' => ['nullable', 'string', 'max:255'],
        'subject_id' => ['nullable', 'integer'],
        'causer_type' => ['nullable', 'string', 'max:255'],
        'causer_id' => ['nullable', 'integer'],

        ];
    }
}
