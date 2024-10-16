<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "email" => "required|email|unique:providers,email," .  $this->route("id"),
            "phone" => "required|string|unique:providers,phone," .  $this->route("id"),
            "country" => "required|string|max:255",
            "institution_id" => "required|exists:admins,id",
            "location_id" => "required|exists:areas,id",
        ];
    }
}
