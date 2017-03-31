<?php

namespace Gallib\Macope\App\Services;

use Gallib\Macope\App\Categorization;
use Gallib\Macope\App\Categorize\Categorizer;
use Gallib\Macope\App\JournalEntry;

class CategorizationService
{
    /**
     * Try to apply given categorization to journal entries without categories
     *
     * @param  \Gallib\Macope\App\Categorization $categorization
     * @return void
     */
    public function applyCategorization(Categorization $categorization)
    {
        $categorizer    = new Categorizer();
        $journalEntries = JournalEntry::whereNull('category_id')->get();

        foreach ($journalEntries as $entry) {
            $categorizer->applyCategorization($categorization, $entry);

            $entry->save();
        }
    }
}
