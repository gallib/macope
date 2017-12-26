<?php

namespace Gallib\Macope\App;

use Illuminate\Database\Eloquent\Model;
use Gallib\Macope\App\Traits\Hashable;

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
}
