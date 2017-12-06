<?php

namespace Gallib\Macope\App\Services;

use DateTime;
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
     * @param string       $type
     * @param integer|null $year
     * @return  string
     */
    public function getYearlyBilling($type = 'debit', $year = null)
    {
        $results = $this->journalEntryQuery->getYearlyBilling($type, $year);

        $billing = [];

        foreach ($results as $result) {
            foreach (range(1, 12) as $month) {
                if (!isset($billing[$result->year][$result->type_category_name][$result->category_name][$month])) {
                    $billing[$result->year][$result->type_category_name][$result->category_name][$month] = [
                        $type => 0
                    ];
                }
            }

            $billing[$result->year][$result->type_category_name][$result->category_name][$result->month] = [
                $type => $result->{$type}
            ];
        }

        return $billing;
    }

    /**
     * Returns years that have at least one entry
     *
     * @return array
     */
    public function getAvailableYears()
    {
        return $this->journalEntryQuery->getAvailableYears();
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
        return $this->journalEntryQuery->getSumByMonth(null, $dateFrom, $dateTo)->each(function($entry){
            if (is_null($entry->debit)) {
                $entry->debit = 0;
            }

            if (is_null($entry->credit)) {
                $entry->credit = 0;
            }
        })->reverse()->values();
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
        return $this->journalEntryQuery->getSumByMonth('debit', $dateFrom, $dateTo)->reverse()->values();
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
        return $this->journalEntryQuery->getSumByMonth('credit', $dateFrom, $dateTo)->reverse()->values();
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
