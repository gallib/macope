<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TypeCategoryRequest extends FormRequest
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
        $uniqueName = Rule::unique('type_categories', 'name');

        if (! is_null($this->route('type_category'))) {
            $uniqueName->ignore($this->route('type_category'));
        }

        return [
            'name' => ['required', $uniqueName, 'max:255'],
        ];
    }
}
