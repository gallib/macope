<?php

namespace Gallib\Macope\App\Services;

use Gallib\Macope\App\Queries\JournalEntryQuery;

class JournalEntryService
{
    /**
     * @var \Gallib\Macope\App\Queries\JournalEntryQuery
     */
    protected $journalEntryQuery;

    public function __construct(JournalEntryQuery $journalEntryQuery)
    {
        $this->journalEntryQuery = $journalEntryQuery;
    }

    /**
     * Get the yearly billing and format results
     *
     * @return  string
     */
    public function getYearlyBilling()
    {
        $results = $this->journalEntryQuery->getYearlyBilling();

        $billing = [];

        foreach ($results as $result) {
            foreach (range(1, 12) as $month) {
                if (!isset($billing[$result->year][$result->type_category_name][$result->category_name][$month])) {
                    $billing[$result->year][$result->type_category_name][$result->category_name][$month] = [
                        'credit' => 0,
                        'debit'  => 0
                    ];
                }
            }

            $billing[$result->year][$result->type_category_name][$result->category_name][$result->month] = [
                'credit' => $result->credit ?: 0,
                'debit'  => $result->debit ?: 0
            ];
        }

        return $billing;
    }
}
