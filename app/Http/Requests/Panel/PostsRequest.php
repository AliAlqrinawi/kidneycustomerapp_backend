<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostsRequest extends FormRequest
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

        $rules['category_id'] = 'required';
        
        foreach (locales() as $key => $language) {
            $rules['title_' . $key] = 'required';
            $rules['text_' . $key] = 'required';
        }

        return $rules;
    }
}
