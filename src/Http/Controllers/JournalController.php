<?php

namespace Gallib\Macope\Http\Controllers;

use Carbon\Carbon;
use Gallib\Macope\Category;
use Illuminate\Http\Request;
use Gallib\Macope\JournalEntry;
use App\Http\Controllers\Controller;
use Gallib\Macope\Services\JournalEntryService;
use Gallib\Macope\Http\Requests\JournalEntryRequest;

class JournalController extends Controller
{
    /**
     * @var \Gallib\Macope\App\Service\JournalEntryService
     */
    protected $journalEntryService;

    /**
     * Create a new controller instance.
     *
     * @param \Gallib\Macope\Services\JournalEntryService $journalEntryService
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
        if (request()->wantsJson()) {
            return [
                'data' => JournalEntry::get(),
            ];
        }

        return view('macope::journal.index');
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
        $categories = Category::get()->sortBy('name')->pluck('name_with_type_category', 'id');

        return view('macope::journal.edit', compact(['journalEntry', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Gallib\Macope\Http\Requests\JournalEntryRequest  $request
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
     * Return expenses sum group by month.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function sumByMonth(Request $request)
    {
        $dateFrom = $request->has('date_from') ? new Carbon($request->get('date_from')) : null;
        $dateTo = $request->has('date_to') ? new Carbon($request->get('date_to')) : null;

        return $this->journalEntryService->getSumByMonth($dateFrom, $dateTo);
    }
}
