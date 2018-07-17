<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\AccountRequest;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::get();

        return view('accounts.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        Account::create($request->all());

        return redirect()
            ->route('accounts.index')
            ->with('flash', 'The account has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view('accounts.show', compact(['account']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', compact(['account']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AccountRequest  $request
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, Account $account)
    {
        $account->update($request->all());

        return redirect()
                ->route('accounts.index')
                ->with('flash', 'The account has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        if ($account->journalEntries()->count() > 0) {
            throw new \Exception('The account can\'t be deleted.');
        }

        $account->delete();

        return redirect()
                ->route('accounts.index')
                ->with('flash', 'The account has been deleted!');
    }
}
