<?php

namespace Gallib\Macope\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gallib\Macope\JournalEntry;
use Gallib\Macope\Services\JournalEntryService;

class DashboardController extends Controller
{
    /**
     * @var \Gallib\Macope\App\Service\JournalEntryService
     */
    protected $journalEntryService;

    /**
     * Create a new controller instance.
     *
     * @param  \Gallib\Macope\Services\JournalEntryService $journalEntryService
     * @return void
     */
    public function __construct(JournalEntryService $journalEntryService)
    {
        $this->middleware('auth');

        $this->journalEntryService = $journalEntryService;
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startOfMonth         = Carbon::now()->startOfMonth();
        $currentMonthExpenses = $this->journalEntryService->getExpensesSumByMonth($startOfMonth);
        $currentMonthExpenses = $currentMonthExpenses->isNotEmpty() ? $currentMonthExpenses->first()->debit : 0;
        $lastMonthIncomes     = $this->journalEntryService->getIncomesSumByMonth($startOfMonth->subMonth());
        $lastMonthIncomes     = $lastMonthIncomes->isNotEmpty() ? $lastMonthIncomes->first()->credit : 0;
        $entryToCategorize    = JournalEntry::whereNull('category_id')->count();

        return view('macope::dashboard.index', compact(['currentMonthExpenses', 'lastMonthIncomes', 'entryToCategorize']));
    }
}
