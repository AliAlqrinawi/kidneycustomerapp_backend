<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['name'] = 'required|string';
        $rules['institution_id'] = 'nullable|exists:admins,id';

        if (request()->route('id')) {
            $rules['email'] = 'required|email|' . Rule::unique('admins')->whereNotNull('email')->whereNot('id', request()->route('id'))->whereNull('deleted_at');
        } else {
            $rules['email'] = 'required|email|' . Rule::unique('admins')->whereNotNull('email')->whereNull('deleted_at');
            $rules['password'] = 'required';
        }

        return $rules;
    }
}
