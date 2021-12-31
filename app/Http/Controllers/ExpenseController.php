<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use App\Services\JournalEntryService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * @var \App\Service\JournalEntryService
     */
    protected $journalEntryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JournalEntryService $journalEntryService)
    {
        $this->middleware('auth');

        $this->journalEntryService = $journalEntryService;
    }

    /**
     * Show the yearly billing.
     *
     * @param  int  $currentYear
     * @return \Illuminate\Http\Response
     */
    public function index($currentYear = null)
    {
        if (is_null($currentYear)) {
            $currentYear = Carbon::now()->format('Y');
        }

        $expenses = $this->journalEntryService->getYearlyBilling('debit', $currentYear);
        $years = JournalEntry::availableYears()->whereNotNull('debit')->get();

        return view('expenses.index', compact(['expenses', 'currentYear', 'years']));
    }

    /**
     * Return expenses sum group by month.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function sumByMonth(Request $request)
    {
        $dateFrom = $request->has('date_from') ? new Carbon($request->get('date_from')) : null;
        $dateTo = $request->has('date_to') ? new Carbon($request->get('date_to')) : null;

        return $this->journalEntryService->getExpensesSumByMonth($dateFrom, $dateTo);
    }

    /**
     * Return expenses group by type category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function expensesByTypeCategory(Request $request)
    {
        $dateFrom = $request->has('date_from') ? new Carbon($request->get('date_from')) : null;
        $dateTo = $request->has('date_to') ? new Carbon($request->get('date_to')) : null;

        return $this->journalEntryService->getExpensesByTypeCategory($dateFrom, $dateTo);
    }

    /**
     * Return monthly expenses group by type category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function monthlyExpensesByTypeCategory(Request $request)
    {
        return $this->journalEntryService->getMonthlyExpensesByTypeCategory($request);
    }

    /**
     * Return monthly expenses group by category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function monthlyExpensesByCategory(Request $request)
    {
        return $this->journalEntryService->getMonthlyExpensesByCategory($request);
    }
}
