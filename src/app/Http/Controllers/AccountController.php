<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Gallib\Macope\App\Account;
use Gallib\Macope\App\Http\Requests\AccountRequest;
use Gallib\Macope\App\Queries\JournalEntryQuery;

class AccountController extends Controller
{
    /**
     * @var \Gallib\Macope\App\Queries\JournalEntryQuery
     */
    protected $journalEntryQuery;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JournalEntryQuery $journalEntryQuery)
    {
        $this->journalEntryQuery = $journalEntryQuery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::get();

        return view('macope::accounts.index', ['accounts' => $accounts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Gallib\Macope\App\Http\Requests\AccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
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
                ->route('accounts.index')
                ->withSuccess(['success' => 'The account has been added']);
        } catch (\Exception $e) {
            return redirect()
                ->route('accounts.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account  = Account::findOrFail($id);
        $balances = $this->journalEntryQuery->getMonthlyBalances($account->id);

        return view('macope::accounts.show', compact(array('account', 'balances')));
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

        return view('macope::accounts.edit', compact(array('account')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Gallib\Macope\App\Http\Requests\AccountRequest  $request
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
