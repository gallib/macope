<?php

namespace Gallib\Macope\App\Observers;

use Gallib\Macope\App\Categorize\Categorizer;
use Gallib\Macope\App\JournalEntry;

class JournalEntryObserver
{
    /**
     * Listen to the JournalEntry created event.
     *
     * @param  \Gallib\Macope\App\JournalEntry  $entry
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
     * Call the categorizer to categorize the given JournalEntry
     *
     * @param  \Gallib\Macope\App\JournalEntry $entry
     * @return void
     */
    protected function categorize(JournalEntry $entry)
    {
        $categorizer = new Categorizer();

        $categorizer->categorize($entry);
    }

    /**
     * Generate a unique hash for the given journal entry
     *
     * @param  \Gallib\Macope\App\JournalEntry $entry
     * @return \Gallib\Macope\App\Observers\JournalEntryObserver
     */
    protected function generateHash(JournalEntry $entry)
    {
        $entry->hash = $entry->generateHash();

        return $this;
    }

    /**
     * Save the original values
     *
     * @param  \Gallib\Macope\App\JournalEntry $entry
     * @return \Gallib\Macope\App\Observers\JournalEntryObserver
     */
    protected function saveOriginalValues(JournalEntry $entry)
    {
        $entry->original_values = $entry->toJson();

        return $this;
    }
}