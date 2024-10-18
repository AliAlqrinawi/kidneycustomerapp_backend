<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'note' => 'nullable|string|max:255',
            // 'institution_id' => 'required|integer|exists:institutions,id',
            'user_id' => 'required|integer|exists:users,id',
            'provider_id' => 'required|integer|exists:providers,id',
        ];
    }
}
