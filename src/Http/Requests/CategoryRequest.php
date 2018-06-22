<?php

namespace Gallib\Macope\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $uniqueName = 'unique_with:categories,type_category_id';

        if (! is_null($this->route('category'))) {
            $uniqueName .= ','.$this->route('category');
        }

        return [
            'name' => ['required', $uniqueName, 'max:255'],
            'type_category_id' => ['required', 'exists:type_categories,id'],
            'is_ignored' => 'boolean',
        ];
    }
}
