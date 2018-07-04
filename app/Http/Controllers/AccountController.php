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
            ->withSuccess(['success' => 'The account has been added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::findOrFail($id);

        return view('accounts.show', compact(['account']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);

        return view('accounts.edit', compact(['account']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AccountRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, $id)
    {
        $account = Account::findOrFail($id);

        $account->update($request->all());

        return redirect()
                ->route('accounts.index')
                ->withSuccess(['success' => 'The account has been successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::findOrFail($id);

        if ($account->journalEntries()->count() > 0) {
            throw new \Exception('The account can\'t be deleted.');
        }

        $account->delete();

        return redirect()
                ->route('accounts.index');
    }
}
