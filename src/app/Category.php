<?php

namespace Gallib\Macope\App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type_category_id'
    ];

    /**
     * Define the inverse one-to-many relationship with TypeCategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeCategory()
    {
        return $this->belongsTo(TypeCategory::class);
    }
}
