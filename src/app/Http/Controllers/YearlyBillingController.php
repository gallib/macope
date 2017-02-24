<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gallib\Macope\App\Services\JournalEntryService;

class YearlyBillingController extends Controller
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
    public function __construct(JournalEntryService $journalEntryService)
    {
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

        $billing = $this->journalEntryService->getYearlyBilling($currentYear);
        $years   = $this->journalEntryService->getAvailableYears();

        return view('macope::yearly-billing.index', compact(['billing', 'currentYear', 'years']));
    }
}
