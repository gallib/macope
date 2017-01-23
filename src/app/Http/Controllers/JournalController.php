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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $account = $request->get('account', null);

        if ($account) {
            $entries = JournalEntry::where('account_id', $account)->get();
        } else {
            $entries = JournalEntry::get();
        }

        $accounts = ['' => 'All'] + Account::pluck('name', 'id')->toArray();

        return view('macope::journal.index', ['entries' => $entries, 'accounts' => $accounts, 'account' => $account]);
    }
}
