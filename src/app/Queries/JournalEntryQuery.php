<?php

namespace Gallib\Macope\App\Queries;

use DateTime;
use Gallib\Macope\App\JournalEntry;

class JournalEntryQuery extends AbstractQuery
{
    /**
     * Specify the model class name
     *
     * @return  string
     */
    protected function modelClassName()
    {
        return JournalEntry::class;
    }

    /**
     * Get expenses by type category
     *
     * @param  integer $months
     * @return \Illuminate\Support\Collection
     */
    public function getExpensesByTypeCategory($months = 12)
    {
        $query = \DB::table('journal_entries')
            ->select('type_categories.name', \DB::raw('SUM(journal_entries.debit) as debit'))
            ->join('categories', 'categories.id', '=', 'journal_entries.category_id')
            ->join('type_categories', 'type_categories.id', '=', 'categories.type_category_id')
            ->where('categories.is_ignored', '=', 0)
            ->where('journal_entries.date', '>=' , \DB::raw('DATE_SUB(now(), INTERVAL ' . $months . ' MONTH)'))
            ->where('debit', '>', 0)
            ->groupBy('type_categories.name')
            ->orderBy('debit', 'desc');

        return $query->get();
    }
}
