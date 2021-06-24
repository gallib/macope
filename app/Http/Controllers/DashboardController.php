<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use App\Services\JournalEntryService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * @var \App\Service\JournalEntryService
     */
    protected $journalEntryService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\JournalEntryService $journalEntryService
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
        $startOfMonth = Carbon::now()->startOfMonth();
        $currentMonthExpenses = $this->journalEntryService->getExpensesSumByMonth($startOfMonth);
        $currentMonthExpenses = $currentMonthExpenses->isNotEmpty() ? $currentMonthExpenses->first()->debit : 0;
        $lastMonthIncomes = $this->journalEntryService->getIncomesSumByMonth($startOfMonth->subMonth());
        $lastMonthIncomes = $lastMonthIncomes->isNotEmpty() ? $lastMonthIncomes->first()->credit : 0;
        $entryToCategorize = JournalEntry::whereNull('category_id')->count();

        return view('dashboard.index', compact(['currentMonthExpenses', 'lastMonthIncomes', 'entryToCategorize']));
    }
}
