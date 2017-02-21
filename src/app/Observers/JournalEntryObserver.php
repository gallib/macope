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
}