<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gallib\Macope\App\Services\JournalEntryService;

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
     * @param integer $currentYear
     * @return \Illuminate\Http\Response
     */
    public function index($currentYear = null)
    {
        if (is_null($currentYear)) {
            $currentYear = Carbon::now()->format('Y');
        }

        $incomes = $this->journalEntryService->getYearlyBilling('credit', $currentYear);
        $years   = $this->journalEntryService->getAvailableYears();

        return view('macope::incomes.index', compact(['incomes', 'currentYear', 'years']));
    }
}
