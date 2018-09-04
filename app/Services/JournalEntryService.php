<?php

namespace App\Services;

use DateTime;
use App\JournalEntry;

class JournalEntryService
{
    /**
     * Get the yearly billing and format results.
     *
     * @param  string       $type
     * @param  null|int $year
     * @return array
     */
    public function getYearlyBilling($type, $year = null)
    {
        $results = JournalEntry::yearlyBilling($type, $year)->get();
        $billing = [];

        foreach ($results as $result) {
            $typeCategory = $result->category->typeCategory;

            if (! isset($billing[$typeCategory->id])) {
                $billing[$typeCategory->id] = [
                    'type_category' => $typeCategory,
                    'categories'    => [],
                ];
            }

            if (! isset($billing[$typeCategory->id]['categories'][$result->category->id])) {
                $billing[$typeCategory->id]['categories'][$result->category->id] = [
                    'category' => $result->category,
                    'months'   => array_fill(1, 12, 0),
                ];
            }

            $billing[$typeCategory->id]['categories'][$result->category->id]['months'][$result->month] = $result->{$type};
        }

        return $billing;
    }

    /**
     * Get sum group by month.
     *
     * @param  \DateTime $dateFrom
     * @param  \DateTime $dateTo
     * @return \Illuminate\Support\Collection
     */
    public function getSumByMonth(DateTime $dateFrom = null, DateTime $dateTo = null)
    {
        return JournalEntry::sumByMonth(null, $dateFrom, $dateTo)
            ->get()
            ->each(function ($entry) {
                if (is_null($entry->debit)) {
                    $entry->debit = 0;
                }

                if (is_null($entry->credit)) {
                    $entry->credit = 0;
                }
            })->values();
    }

    /**
     * Get expenses sum group by month.
     *
     * @param  \DateTime $dateFrom
     * @param  \DateTime $dateTo
     * @return \Illuminate\Support\Collection
     */
    public function getExpensesSumByMonth(DateTime $dateFrom = null, DateTime $dateTo = null)
    {
        return JournalEntry::sumByMonth('debit', $dateFrom, $dateTo)
            ->get()
            ->each(function ($entry) {
                if (is_null($entry->debit)) {
                    $entry->debit = 0;
                }
            })->values();
    }

    /**
     * Get incomes sum group by month.
     *
     * @param  \DateTime $dateFrom
     * @param  \DateTime $dateTo
     * @return \Illuminate\Support\Collection
     */
    public function getIncomesSumByMonth(DateTime $dateFrom = null, DateTime $dateTo = null)
    {
        return JournalEntry::sumByMonth('credit', $dateFrom, $dateTo)
            ->get()
            ->each(function ($entry) {
                if (is_null($entry->credit)) {
                    $entry->credit = 0;
                }
            })->values();
    }

    /**
     * Get expenses by type category.
     *
     * @param  \DateTime $dateFrom
     * @param  \DateTime $dateTo
     * @return \Illuminate\Support\Collection
     */
    public function getExpensesByTypeCategory(DateTime $dateFrom = null, DateTime $dateTo = null)
    {
        $query = JournalEntry::expensesByTypeCategory()
            ->whereHas('category', function ($query) {
                $query->unignored();
            });

        if (! is_null($dateFrom)) {
            $query->where('journal_entries.date', '>=', $dateFrom->format('Y-m-d H:i:s'));
        }

        if (! is_null($dateTo)) {
            $query->where('journal_entries.date', '<=', $dateTo->format('Y-m-d H:i:s'));
        }

        return $query->get();
    }
}
