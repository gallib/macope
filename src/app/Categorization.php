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
        'category_id'
    ];

    protected $types = [
        'contains',
        'match'
    ];

    public function getTypes()
    {
        return $this->types;
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
