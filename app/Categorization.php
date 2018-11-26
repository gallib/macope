<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'search',
        'search_type',
        'entry_type',
        'amount',
        'category_id',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'category',
    ];

    /**
     * The search types values.
     *
     * @var array
     */
    protected $searchTypes = [
        'contains',
        'match',
    ];

    /**
     * The entry types values.
     *
     * @var array
     */
    protected $entryTypes = [
        'debit',
        'credit',
    ];

    /**
     * Getter for search types.
     *
     * @return array
     */
    public function getSearchTypes()
    {
        return $this->searchTypes;
    }

    /**
     * Getter for entry types.
     *
     * @return array
     */
    public function getEntryTypes()
    {
        return $this->entryTypes;
    }

    /**
     * Define the inverse one-to-many relationship with Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
