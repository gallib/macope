<?php

namespace Gallib\Macope\App;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
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
        'balance',
        'account_id'
    ];

    /**
     * Define the inverse one-to-many relationship with Account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
