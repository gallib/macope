<?php

namespace Gallib\Macope\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JournalEntryRequest extends FormRequest
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
            'date' => ['required', 'date_format:Y-m-d'],
            'text' => ['required'],
            'category_id' => 'nullable|exists:categories,id',
            'credit' => ['nullable', 'numeric'],
            'debit' => ['nullable', 'numeric']
        ];
    }
}
