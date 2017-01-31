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
}
