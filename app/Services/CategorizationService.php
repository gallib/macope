<?php

namespace App\Services;

use App\Categorization;
use App\Categorize\Categorizer;
use App\JournalEntry;

class CategorizationService
{
    /**
     * Try to apply given categorization to journal entries without categories.
     *
     * @param  \Gallib\Macope\Categorization $categorization
     * @return void
     */
    public function applyCategorization(Categorization $categorization)
    {
        $categorizer = new Categorizer();
        $journalEntries = JournalEntry::whereNull('category_id')->get();

        foreach ($journalEntries as $entry) {
            $categorizer->applyCategorization($categorization, $entry);

            $entry->save();
        }
    }
}
