<?php

namespace Gallib\Macope\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Gallib\Macope\JournalEntry;
use App\Http\Controllers\Controller;
use Gallib\Macope\Services\JournalEntryService;

class IncomeController extends Controller
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
     * Show the yearly income.
     *
     * @param int $currentYear
     * @return \Illuminate\Http\Response
     */
    public function index($currentYear = null)
    {
        if (is_null($currentYear)) {
            $currentYear = Carbon::now()->format('Y');
        }

        $incomes = $this->journalEntryService->getYearlyBilling('credit', $currentYear);
        $years = JournalEntry::availableYears()->whereNotNull('credit')->get();

        return view('macope::incomes.index', compact(['incomes', 'currentYear', 'years']));
    }

    /**
     * Return incomes sum group by month.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function sumByMonth(Request $request)
    {
        $dateFrom = $request->has('date_from') ? new Carbon($request->get('date_from')) : null;
        $dateTo = $request->has('date_to') ? new Carbon($request->get('date_to')) : null;

        return $this->journalEntryService->getIncomesSumByMonth($dateFrom, $dateTo);
    }
}
