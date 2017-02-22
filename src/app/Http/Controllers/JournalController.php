<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Gallib\Macope\App\Account;
use Gallib\Macope\App\JournalEntry;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the journal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account  = null;
        $entries  = JournalEntry::with('category')->get();
        $accounts = ['' => 'All'] + Account::pluck('name', 'id')->toArray();

        return view('macope::journal.index', compact(['entries', 'accounts', 'account']));
    }

    /**
     * Apply filters and show the journal.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $account  = $request->get('account', null);
        $entries  = JournalEntry::where('account_id', $account)->get();
        $accounts = ['' => 'All'] + Account::pluck('name', 'id')->toArray();

        return view('macope::journal.index', compact(['entries', 'accounts', 'account']));
    }
}
