<?php

namespace App\Observers;

use App\Categorize\Categorizer;
use App\JournalEntry;

class JournalEntryObserver
{
    /**
     * Listen to the JournalEntry created event.
     *
     * @param  \App\JournalEntry  $entry
     * @return void
     */
    public function creating(JournalEntry $entry)
    {
        if (is_null($entry->category_id)) {
            $this->categorize($entry);
        }

        $this
            ->generateHash($entry)
            ->saveOriginalValues($entry);
    }

    /**
     * Call the categorizer to categorize the given JournalEntry.
     *
     * @param  \App\JournalEntry $entry
     * @return void
     */
    protected function categorize(JournalEntry $entry)
    {
        $categorizer = new Categorizer();

        $categorizer->categorize($entry);
    }

    /**
     * Generate a unique hash for the given journal entry.
     *
     * @param  \App\JournalEntry $entry
     * @return \App\Observers\JournalEntryObserver
     */
    protected function generateHash(JournalEntry $entry)
    {
        $entry->hash = $entry->generateHash();

        return $this;
    }

    /**
     * Save the original values.
     *
     * @param  \App\JournalEntry $entry
     * @return \App\Observers\JournalEntryObserver
     */
    protected function saveOriginalValues(JournalEntry $entry)
    {
        $entry->original_values = $entry->toJson();

        return $this;
    }
}
