<?php

namespace Gallib\Macope\App;

use Illuminate\Database\Eloquent\Model;
use Gallib\Macope\App\Traits\Hashable;
use \DateTime;

class JournalEntry extends Model
{
    use Hashable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'text',
        'credit',
        'debit',
        'category_id',
        'account_id'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'category'
    ];

    /**
     * The attributes we must hash with
     *
     * @var array
     */
    protected $hashWith = [
        'date',
        'text',
        'credit',
        'debit',
        'account_id'
    ];

    /**
     * Define the inverse one-to-many relationship with Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Define the inverse one-to-many relationship with Account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Scope a query to get the yearly billing.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string                                $type
     * @param  null|integer                          $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeYearlyBilling($query, $type, $year = null)
    {
        $monthEndsOn = config('macope.month_ends_on');

        $query
            ->select('category_id')
            ->selectRaw('YEAR(date_add(date, interval (day(last_day(date)) - ?) day)) as year', [$monthEndsOn])
            ->selectRaw('MONTH(date_add(date, interval (day(last_day(journal_entries.date)) - ?) day)) as month', [$monthEndsOn])
            ->selectRaw("SUM($type) as $type")
            ->whereNotNull($type)
            ->whereHas('category', function ($query) {
                $query->where('is_ignored', '=', 0);
            })
            ->groupBy('category_id', 'year', 'month');

        if (!is_null($year)) {
            $query->whereRaw('YEAR(date_add(journal_entries.date, interval (day(last_day(date)) - ?) day)) = ?', [$monthEndsOn, $year]);
        }
    }

    /**
     * Scope a query to get years that have at least one entry
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailableYears($query)
    {
        $monthEndsOn = config('macope.month_ends_on');

        $query
            ->selectRaw('YEAR(date_add(date, interval (day(last_day(date)) - ?) day)) as year', [$monthEndsOn])
            ->groupBy('year');

        return $query;
    }

    /**
     * Scope a query to qet expenses or incomes group by month
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|null                           $type
     * @param  \DateTime                             $dateStart
     * @param  \DateTime                             $dateEnd
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSumByMonth($query, $type = null, DateTime $dateStart = null, DateTime $dateEnd = null)
    {
        $monthEndsOn = config('macope.month_ends_on');

        $query
            ->selectRaw('YEAR(date_add(date, interval (day(last_day(date)) - ?) day)) as year', [$monthEndsOn])
            ->selectRaw('MONTH(date_add(date, interval (day(last_day(journal_entries.date)) - ?) day)) as month', [$monthEndsOn])
            ->whereHas('category', function ($query) {
                $query->where('is_ignored', '=', 0);
            })
            ->groupBy('year', 'month');

        if (is_null($type)) {
            $query
                ->selectRaw('SUM(journal_entries.debit) as debit')
                ->selectRaw('SUM(journal_entries.credit) as credit');
        } else {
            $query->selectRaw("SUM(journal_entries.$type) as $type");
        }

        if (!is_null($dateStart)) {
            $query->where('journal_entries.date', '>=' , $dateStart->format('Y-m-d H:i:s'));
        }

        if (!is_null($dateEnd)) {
            $query->where('journal_entries.date', '<=' , $dateEnd->format('Y-m-d H:i:s'));
        }

        return $query;
    }

    /**
     * Scope a query to get expenses by type category
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  \DateTime|null                        $dateStart
     * @param  \DateTime|null                        $dateEnd
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpensesByTypeCategory($query, DateTime $dateStart = null, DateTime $dateEnd = null)
    {
        $query
            ->select('type_categories.name')
            ->selectRaw('SUM(journal_entries.debit) as debit')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('type_categories', 'type_categories.id', '=', 'categories.type_category_id')
            ->whereHas('category', function ($query) {
                $query->where('is_ignored', '=', 0);
            })
            ->where('debit', '>', 0)
            ->groupBy('type_categories.name')
            ->orderBy('debit', 'desc');

        if (!is_null($dateStart)) {
            $query->where('journal_entries.date', '>=' , $dateStart->format('Y-m-d H:i:s'));
        }

        if (!is_null($dateEnd)) {
            $query->where('journal_entries.date', '<=' , $dateEnd->format('Y-m-d H:i:s'));
        }

        return $query;
    }
}
