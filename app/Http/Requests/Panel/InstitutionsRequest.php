<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstitutionsRequest extends FormRequest
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
        $rules['name'] = 'required|string';
        $rules['email'] = request()->route('id') ? 'required|email|' . Rule::unique('admins')->whereNotNull('email')->whereNot('id', request()->route('id'))->whereNull('deleted_at')
        : 'required|email|' . Rule::unique('admins')->whereNotNull('email')->whereNull('deleted_at');
        $rules['password'] = request()->route('id') ? "nullable" : "required";
        $rules['image'] = request()->route('id') ? "nullable" : "required";
        $rules['phone'] = 'required|numeric';
        $rules['description'] = 'required|string|max:255';
        return $rules;
    }
}
