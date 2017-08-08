<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gallib\Macope\App\Services\JournalEntryService;

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

        $billing = $this->journalEntryService->getYearlyBilling('debit', $currentYear);
        $years   = $this->journalEntryService->getAvailableYears();

        return view('macope::expenses.index', compact(['billing', 'currentYear', 'years']));
    }
}
