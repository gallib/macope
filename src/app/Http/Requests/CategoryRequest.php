<?php

namespace Gallib\Macope\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $uniqueName = Rule::unique('categories', 'name');

        if (!is_null($this->route('category'))) {
            $uniqueName->ignore($this->route('category'));
        }

        return [
            'name' => ['required', $uniqueName, 'max:255'],
            'type_category_id' => ['required', 'exists:type_categories,id']
        ];
    }
}
