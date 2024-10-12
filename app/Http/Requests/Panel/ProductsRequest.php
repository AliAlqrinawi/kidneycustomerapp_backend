<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductsRequest extends FormRequest
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

        $rules['image'] = 'required';
        $rules['price'] = 'required';

        if (!request()->route('id')) {
            $rules['quantity'] = 'required';
        }

        foreach (locales() as $key => $language) {
            $rules['title_' . $key] = 'required';
            $rules['text_' . $key] = 'required';
        }

        return $rules;
    }
}
