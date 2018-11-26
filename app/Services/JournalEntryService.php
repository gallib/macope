<?php

namespace App\Services;

use DateTime;
use Carbon\Carbon;
use App\JournalEntry;
use Illuminate\Http\Request;

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
            })
            ->orderBy('debit', 'desc');

        if (! is_null($dateFrom)) {
            $query->where('journal_entries.date', '>=', $dateFrom->format('Y-m-d H:i:s'));
        }

        if (! is_null($dateTo)) {
            $query->where('journal_entries.date', '<=', $dateTo->format('Y-m-d H:i:s'));
        }

        return $query->get();
    }

    /**
     * Get expenses by type category.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getMonthlyExpensesByTypeCategory(Request $request)
    {
        $query = JournalEntry::expensesByTypeCategory()
            ->selectRaw('YEAR(date) as year')
            ->selectRaw('MONTH(date) as month')
            ->whereHas('category', function ($query) {
                $query->unignored();
            })
            ->groupBy('year', 'month');

        if ($request->has('date_from')) {
            $query->where('journal_entries.date', '>=', (new Carbon($request->get('date_from')))->format('Y-m-d H:i:s'));
        }

        if ($request->has('date_to')) {
            $query->where('journal_entries.date', '<=', (new Carbon($request->get('date_to')))->format('Y-m-d H:i:s'));
        }

        if ($request->has('type_category')) {
            $query->where('type_categories.id', $request->get('type_category'));
        }

        return $query->get();
    }

    /**
     * Get expenses by category.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getMonthlyExpensesByCategory(Request $request)
    {
        $query = JournalEntry::expensesByCategory()
            ->selectRaw('YEAR(date) as year')
            ->selectRaw('MONTH(date) as month')
            ->groupBy('year', 'month');

        if ($request->has('date_from')) {
            $query->where('journal_entries.date', '>=', (new Carbon($request->get('date_from')))->format('Y-m-d H:i:s'));
        }

        if ($request->has('date_to')) {
            $query->where('journal_entries.date', '<=', (new Carbon($request->get('date_to')))->format('Y-m-d H:i:s'));
        }

        if ($request->has('category')) {
            $query->where('categories.id', $request->get('category'));
        }

        return $query->get();
    }
}
