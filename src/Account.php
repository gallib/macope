<?php

namespace Gallib\Macope;

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
        'account_number',
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
        return $this->hasMany(JournalEntry::class);
    }
}
