<?php

namespace Gallib\Macope\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'name'        => ['required', 'unique:accounts', 'max:255'],
            'description' => ['max:255'],
            'iban'        => ['required', 'unique:accounts', 'max:255'],
            'currency'    => ['required', 'max:3']
        ];
    }
}
