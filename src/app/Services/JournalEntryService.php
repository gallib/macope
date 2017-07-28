<?php

namespace Gallib\Macope\App\Services;

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
}
