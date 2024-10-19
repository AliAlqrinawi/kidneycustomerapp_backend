<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AreasRequest extends FormRequest
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
        $rules['name'] = 'required|string|max:255';
        $rules['institution_id'] = 'required|exists:admins,id';

        if (request()->route('admin_id')) {
            $rules['email'] = 'required|email|' . Rule::unique('admins')->whereNotNull('email')->whereNot('id', request()->route('admin_id'))->whereNull('deleted_at');
        } else {
            $rules['email'] = 'required|email|' . Rule::unique('admins')->whereNotNull('email')->whereNull('deleted_at');
            $rules['password'] = 'required';
        }

        return $rules;
    }
}
