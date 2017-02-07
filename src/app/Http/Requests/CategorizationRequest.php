<?php

namespace Gallib\Macope\App\Http\Requests;

use Gallib\Macope\App\Categorization;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategorizationRequest extends FormRequest
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
        return [
            'search' => ['required', 'max:255'],
            'type' => ['required', Rule::in((new Categorization())->getTypes()), 'max:255'],
            'category_id' => ['required', 'exists:categories,id']
        ];
    }
}
