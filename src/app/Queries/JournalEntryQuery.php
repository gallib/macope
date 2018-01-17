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
     * Returns years that have at least one entry
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAvailableYears()
    {
        $monthEndsOn = config('macope.month_ends_on');

        $query = \DB::table('journal_entries')
            ->select(\DB::raw('YEAR(date_add(journal_entries.date, interval (day(last_day(date)) - ' . $monthEndsOn . ') day)) as year'))
            ->groupBy('year');

        return $query->get();
    }

    /**
     * Get sum of expenses or incomes group by month
     *
     * @param  string|null $type
     * @param  \DateTime   $dateStart
     * @param  \DateTime   $dateEnd
     * @return \Illuminate\Support\Collection
     */
    public function getSumByMonth($type = null, DateTime $dateStart = null, DateTime $dateEnd = null)
    {
        $query = \DB::table('journal_entries')
            ->select(\DB::raw('YEAR(journal_entries.date) as year'), \DB::raw('MONTH(journal_entries.date) as month'))
            ->join('categories', 'categories.id', '=', 'journal_entries.category_id')
            ->where('categories.is_ignored', '=', 0)
            ->groupBy(\DB::raw('YEAR(journal_entries.date) desc, MONTH(journal_entries.date) desc'));

        if (is_null($type)) {
            $query->addSelect(\DB::raw('SUM(journal_entries.debit) as debit'), \DB::raw('SUM(journal_entries.credit) as credit'));
        } else {
            $query->addSelect(\DB::raw('SUM(journal_entries.' . $type . ') as ' . $type));
        }

        if (!is_null($dateStart)) {
            $query->where('journal_entries.date', '>=' , $dateStart->format('Y-m-d H:i:s'));
        }

        if (!is_null($dateEnd)) {
            $query->where('journal_entries.date', '<=' , $dateEnd->format('Y-m-d H:i:s'));
        }

        return $query->get();
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
