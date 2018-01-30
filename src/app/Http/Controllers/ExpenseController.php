<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gallib\Macope\App\JournalEntry;
use Gallib\Macope\App\Services\JournalEntryService;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * @var \Gallib\Macope\App\Service\JournalEntryService
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
     * @param integer $currentYear
     * @return \Illuminate\Http\Response
     */
    public function index($currentYear = null)
    {
        if (is_null($currentYear)) {
            $currentYear = Carbon::now()->format('Y');
        }

        $expenses = $this->journalEntryService->getYearlyBilling('debit', $currentYear);
        $years   = JournalEntry::availableYears()->whereNotNull('debit')->get();

        return view('macope::expenses.index', compact(['expenses', 'currentYear', 'years']));
    }

    /**
     * Return expenses sum group by month
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function sumByMonth(Request $request)
    {
        $dateFrom = $request->has('date_from') ? new Carbon($request->get('date_from')) : null;
        $dateTo   = $request->has('date_to') ? new Carbon($request->get('date_to')) : null;

        return $this->journalEntryService->getExpensesSumByMonth($dateFrom, $dateTo);
    }

    /**
     * Return expenses group by type category
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function expensesByTypeCategory(Request $request)
    {
        $dateFrom = $request->has('date_from') ? new Carbon($request->get('date_from')) : null;
        $dateTo   = $request->has('date_to') ? new Carbon($request->get('date_to')) : null;

        return $this->journalEntryService->getExpensesByTypeCategory($dateFrom, $dateTo);
    }
}
