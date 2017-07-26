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
     * Getter for monthly balances
     *
     * @param  integer $accountId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMonthlyBalances($accountId)
    {
        $query = $this->model->newQuery();

        $query
            ->whereIn('date', function($query) use ($accountId){
                $query
                    ->select(\DB::raw('MAX(date)'))
                    ->from($this->model->getTable())
                    ->whereNotNull('balance')
                    ->where('account_id', '=', $accountId)
                    ->distinct()
                    ->groupBy(\DB::raw('YEAR(date), MONTH(date)'));
            })
            ->whereNotNull('balance')
            ->where('account_id', '=', $accountId);

        return $query->get();
    }

    /**
     * Getter for the yearly billing
     *
     * @param integer|null $year
     * @return \Illuminate\Support\Collection
     */
    public function getYearlyBilling($year = null)
    {
        $query = \DB::table('journal_entries')
            ->select('categories.name as category_name', 'type_categories.name as type_category_name', \DB::raw('YEAR(journal_entries.date) as year'), \DB::raw('MONTH(journal_entries.date) as month'), \DB::raw('SUM(journal_entries.credit) as credit'), \DB::raw('SUM(journal_entries.debit) as debit'))
            ->join('categories', 'categories.id', '=', 'journal_entries.category_id')
            ->join('type_categories', 'type_categories.id', '=', 'categories.type_category_id')
            ->groupBy(\DB::raw('type_categories.name, categories.name, YEAR(journal_entries.date), MONTH(journal_entries.date)'));

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
}
