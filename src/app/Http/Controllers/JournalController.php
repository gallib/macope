<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gallib\Macope\App\Account;
use Gallib\Macope\App\Category;
use Gallib\Macope\App\JournalEntry;
use Gallib\Macope\App\Http\Requests\JournalEntryRequest;
use Gallib\Macope\App\Services\JournalEntryService;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    /**
     * @var \Gallib\Macope\App\Service\JournalEntryService
     */
    protected $journalEntryService;

    /**
     * Create a new controller instance.
     *
     * @param \Gallib\Macope\App\Services\JournalEntryService $journalEntryService
     * @return void
     */
    public function __construct(JournalEntryService $journalEntryService)
    {
        $this->middleware('auth');

        $this->journalEntryService = $journalEntryService;
    }

    /**
     * Show the journal.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $account  = null;
        $accounts = ['' => 'All'] + Account::pluck('name', 'id')->toArray();

        if (request()->wantsJson()) {
            return [
                'data' => JournalEntry::get()
            ];
        }

        return view('macope::journal.index', compact(['accounts', 'account']));
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
        $categories   = Category::get()->sortBy('name')->pluck('name_with_type_category', 'id');

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

    /**
     * Return expenses sum group by month
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function sumByMonth(Request $request)
    {
        $dateFrom = $request->has('date_from') ? new Carbon($request->get('date_from')) : null;
        $dateTo   = $request->has('date_to') ? new Carbon($request->get('date_to')) : null;

        return $this->journalEntryService->getSumByMonth($dateFrom, $dateTo);
    }
}
