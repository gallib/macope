<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Gallib\Macope\App\Account;
use Gallib\Macope\App\Category;
use Gallib\Macope\App\JournalEntry;
use Gallib\Macope\App\Http\Requests\JournalEntryRequest;

class JournalController extends Controller
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
     * Show the journal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account  = null;
        $entries  = JournalEntry::with('category.typeCategory')->get();
        $accounts = ['' => 'All'] + Account::pluck('name', 'id')->toArray();

        return view('macope::journal.index', compact(['entries', 'accounts', 'account']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journalEntry = JournalEntry::findOrFail($id);
        $categories   = Category::with('typeCategory')->get()->sortBy('name')->pluck('name_with_type_category', 'id');

        return view('macope::journal.edit', compact(['journalEntry', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Gallib\Macope\App\Http\Requests\JournalEntryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JournalEntryRequest $request, $id)
    {
        $entry = JournalEntry::findOrFail($id);

        $entry->update($request->all());

        return redirect()
                ->route('journal.index')
                ->withSuccess(['success' => 'The journal entry has been successfully updated.']);
    }

    /**
     * Apply filters and show the journal.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $account  = $request->get('account', null);
        $entries  = JournalEntry::where('account_id', $account)->get();
        $accounts = ['' => 'All'] + Account::pluck('name', 'id')->toArray();

        return view('macope::journal.index', compact(['entries', 'accounts', 'account']));
    }
}
