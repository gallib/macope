<?php

namespace Gallib\Macope\App;

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
        'type',
        'entry_type',
        'amount',
        'category_id'
    ];

    /**
     * The types values
     *
     * @var array
     */
    protected $types = [
        'contains',
        'match'
    ];

    /**
     * The entry types values
     *
     * @var array
     */
    protected $entryTypes = [
        'debit',
        'credit'
    ];

    /**
     * Getter for types
     *
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Getter for entry types
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
