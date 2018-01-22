<?php

namespace Gallib\Macope\App\Services;

use DateTime;
use Gallib\Macope\App\JournalEntry;
use Gallib\Macope\App\Queries\JournalEntryQuery;

class JournalEntryService
{
    /**
     * @var \Gallib\Macope\App\Queries\JournalEntryQuery
     */
    protected $journalEntryQuery;

    /**
     * The constructor
     *
     * @param \Gallib\Macope\App\Queries\JournalEntryQuery $journalEntryQuery
     */
    public function __construct(JournalEntryQuery $journalEntryQuery)
    {
        $this->journalEntryQuery = $journalEntryQuery;
    }

    /**
     * Get the yearly billing and format results
     *
     * @param  string       $type
     * @param  null|integer $year
     * @return array
     */
    public function getYearlyBilling($type, $year = null)
    {
        $results = JournalEntry::yearlyBilling($type, $year)->get();
        $billing = [];

        foreach ($results as $result) {
            $typeCategory = $result->category->typeCategory;

            if (!isset($billing[$typeCategory->id])) {
                $billing[$typeCategory->id] = [
                    'type_category' => $typeCategory,
                    'categories'    => []
                ];
            }

            if (!isset($billing[$typeCategory->id]['categories'][$result->category->id])) {
                $billing[$typeCategory->id]['categories'][$result->category->id] = [
                    'category' => $result->category,
                    'months'   => array_fill(1, 12, 0)
                ];
            };

            $billing[$typeCategory->id]['categories'][$result->category->id]['months'][$result->month] = $result->{$type};
        }

        return $billing;
    }

    /**
     * Get sum group by month
     *
     * @param  \DateTime $dateFrom
     * @param  \DateTime $dateTo
     * @return \Illuminate\Support\Collection
     */
    public function getSumByMonth(DateTime $dateFrom = null, DateTime $dateTo = null)
    {
        return JournalEntry::sumByMonth(null, $dateFrom, $dateTo)
            ->get()
            ->each(function($entry){
                if (is_null($entry->debit)) {
                    $entry->debit = 0;
                }

                if (is_null($entry->credit)) {
                    $entry->credit = 0;
                }
        })->values();
    }

    /**
     * Get expenses sum group by month
     *
     * @param  \DateTime $dateFrom
     * @param  \DateTime $dateTo
     * @return \Illuminate\Support\Collection
     */
    public function getExpensesSumByMonth(DateTime $dateFrom = null, DateTime $dateTo = null)
    {
        return JournalEntry::sumByMonth('debit', $dateFrom, $dateTo)
            ->get()
            ->each(function($entry){
                if (is_null($entry->debit)) {
                    $entry->debit = 0;
                }
        })->values();
    }

    /**
     * Get incomes sum group by month
     *
     * @param  \DateTime $dateFrom
     * @param  \DateTime $dateTo
     * @return \Illuminate\Support\Collection
     */
    public function getIncomesSumByMonth(DateTime $dateFrom = null, DateTime $dateTo = null)
    {
        return JournalEntry::sumByMonth('credit', $dateFrom, $dateTo)
            ->get()
            ->each(function($entry){
                if (is_null($entry->credit)) {
                    $entry->credit = 0;
                }
        })->values();
    }

    /**
     * Get expenses by type category
     *
     * @param  integer $months
     * @return \Illuminate\Support\Collection
     */
    public function getExpensesByTypeCategory($months = 12)
    {
        return $this->journalEntryQuery->getExpensesByTypeCategory($months);
    }
}
