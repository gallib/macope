<?php

namespace App;

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
        'is_ignored',
        'type_category_id',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'typeCategory',
    ];

    /**
     * Define the one-to-many relationship with JournalEntry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    /**
     * Define the one-to-many relationship with Categorization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categorizations()
    {
        return $this->hasMany(Categorization::class);
    }

    /**
     * Define the inverse one-to-many relationship with TypeCategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeCategory()
    {
        return $this->belongsTo(TypeCategory::class);
    }

    /**
     * Getter for category name with typ ecategory name.
     *
     * @return string
     */
    public function getNameWithTypeCategoryAttribute()
    {
        return $this->name.' ('.$this->typeCategory->name.')';
    }
}
