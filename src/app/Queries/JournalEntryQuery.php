<?php

namespace Gallib\Macope\App\Queries;

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
     * Getter for the yearly billing
     *
     * @param string       $type
     * @param integer|null $year
     * @return \Illuminate\Support\Collection
     */
    public function getYearlyBilling($type = 'debit', $year = null)
    {
        $query = \DB::table('journal_entries')
            ->select('categories.name as category_name', 'type_categories.name as type_category_name', \DB::raw('YEAR(journal_entries.date) as year'), \DB::raw('MONTH(journal_entries.date) as month'), \DB::raw('SUM(journal_entries.credit) as credit'), \DB::raw('SUM(journal_entries.debit) as debit'))
            ->join('categories', 'categories.id', '=', 'journal_entries.category_id')
            ->join('type_categories', 'type_categories.id', '=', 'categories.type_category_id')
            ->where('categories.is_ignored', '=', 0)
            ->groupBy(\DB::raw('type_categories.name, categories.name, YEAR(journal_entries.date), MONTH(journal_entries.date)'));

        if (!is_null($type)) {
            $query->whereNotNull($type);
        }

        if (!is_null($year)) {
            $query->whereYear('journal_entries.date', '=', $year);
        }

        return $query->get();
    }

    /**
     * Returns years that have at least one entry
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAvailableYears()
    {
        $query = \DB::table('journal_entries')
            ->select(\DB::raw('YEAR(journal_entries.date) as year'))
            ->groupBy('year');

        return $query->get();
    }

    /**
     * Getter sum of last expenses group by month
     *
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public function getLastExpensesSum($limit = 12)
    {
        $query = \DB::table('journal_entries')
            ->select(\DB::raw('YEAR(journal_entries.date) as year'), \DB::raw('MONTH(journal_entries.date) as month'), \DB::raw('SUM(journal_entries.debit) as debit'))
            ->join('categories', 'categories.id', '=', 'journal_entries.category_id')
            ->where('categories.is_ignored', '=', 0)
            ->groupBy(\DB::raw('YEAR(journal_entries.date) desc, MONTH(journal_entries.date) desc'))
            ->limit($limit);

        return $query->get();
    }
}
