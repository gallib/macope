<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
        $uniqueName = Rule::unique('accounts', 'name');
        $uniqueAccountNumber = Rule::unique('accounts', 'account_number');
        $uniqueIban = Rule::unique('accounts', 'iban');

        if (! is_null($this->route('account'))) {
            $uniqueName->ignore($this->route('account'));
            $uniqueAccountNumber->ignore($this->route('account_number'));
            $uniqueIban->ignore($this->route('account'));
        }

        return [
            'name'           => ['required', $uniqueName, 'max:255'],
            'description'    => ['max:255'],
            'account_number' => ['required', $uniqueAccountNumber, 'max:255'],
            'iban'           => ['required', $uniqueIban, 'max:255'],
            'currency'       => ['required', 'max:3'],
        ];
    }
}
