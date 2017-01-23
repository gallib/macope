<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Gallib\Macope\App\Account;
use Gallib\Macope\App\Http\Requests\AccountRequest;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the account form and the list of account.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::get();

        return view('macope::account.index', ['accounts' => $accounts]);
    }

    /**
     * Add an account.
     *
     * @param  \Gallib\Macope\App\Http\Requests\AccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function add(AccountRequest $request)
    {
        try {
            $data = [
                'name'        => $request->get('name'),
                'description' => $request->get('description', null),
                'iban'        => $request->get('iban'),
                'currency'    => $request->get('currency')
            ];
            Account::create($data);
            return redirect()
                ->route('account')
                ->withSuccess(['success' => 'The account has been added']);
        } catch (\Exception $e) {
            return redirect()
                ->route('account')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}
