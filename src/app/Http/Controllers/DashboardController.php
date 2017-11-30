<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gallib\Macope\App\Services\JournalEntryService;

class DashboardController extends Controller
{
    /**
     * @var \Gallib\Macope\App\Service\JournalEntryService
     */
    protected $journalEntryService;

    /**
     * Create a new controller instance.
     *
     * @param  \Gallib\Macope\App\Services\JournalEntryService $journalEntryService
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
        $currentMonthExpenses = $this->journalEntryService->getLastExpensesSum($startOfMonth);
        $currentMonthExpenses = !empty($currentMonthExpenses) ? $currentMonthExpenses[0] : 0;
        $lastMonthIncomes     = $this->journalEntryService->getIncomesSumByMonth($startOfMonth->subMonth());
        $lastMonthIncomes     = !empty($lastMonthIncomes) ? $lastMonthIncomes[0] : 0;

        return view('macope::dashboard.index', compact(['currentMonthExpenses', 'lastMonthIncomes']));
    }
}
