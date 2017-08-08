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
        $categorization = new Categorization();

        return [
            'search' => ['required', 'max:255'],
            'search_type' => ['required', Rule::in($categorization->getSearchTypes()), 'max:255'],
            'entry_type' => ['required', Rule::in($categorization->getEntryTypes()), 'max:255'],
            'amount' => ['nullable', 'numeric'],
            'category_id' => ['required', 'exists:categories,id']
        ];
    }
}
