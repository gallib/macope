<?php

namespace Gallib\Macope\App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'iban',
        'currency'
    ];

    /**
     * Define the one-to-many relationship with JournalEntry
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function journalEntries()
    {
        return $this->hasMany(journalEntry::class);
    }
}
