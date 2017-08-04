<?php

namespace Gallib\Macope\App\Categorize;

use Gallib\Macope\App\Categorization;
use Gallib\Macope\App\JournalEntry;

class Categorizer
{
    /**
     * Try to categorize the given journal entry

     * @param  \Gallib\Macope\App\JournalEntry $entry
     * @return void
     */
    public function categorize(JournalEntry $entry)
    {
        $categorizations = Categorization::all()->sortByDesc('amount');

        foreach ($categorizations as $categorization) {
            if ($this->applyCategorization($categorization, $entry)) {
                break;
            }
        }
    }

    /**
     * Try to apply given categorization to journal entries
     *
     * @param  \Gallib\Macope\App\Categorization $categorization
     * @param  \Gallib\Macope\App\JournalEntry $entry
     * @return boolean
     */
    public function applyCategorization(Categorization $categorization, JournalEntry $entry)
    {
        if (!method_exists($this, $categorization->type)) {
            throw new \Exception("$categorization->type is not a valid categorization type");
        }

        if (!$this->checkEntryType($entry, $categorization)) {
            return false;
        }

        if (!$this->checkAmount($entry, $categorization)) {
            return false;
        }

        if (!$this->{$categorization->type}($entry, $categorization)) {
            return false;
        }

        $entry->category_id = $categorization->category_id;

        return true;
    }

    /**
     * Check if the categorization search string is found in the journal entry text
     *
     * @param  \Gallib\Macope\App\JournalEntry   $entry
     * @param  \Gallib\Macope\App\Categorization $categorization
     * @return boolean
     */
    protected function contains(JournalEntry $entry, Categorization $categorization)
    {
        return mb_stripos($entry->text, $categorization->search) !== false;
    }

    /**
     * Check if the categorization match with the journal entry
     *
     * @param  \Gallib\Macope\App\JournalEntry   $entry
     * @param  \Gallib\Macope\App\Categorization $categorization
     * @return boolean
     */
    protected function match(JournalEntry $entry, Categorization $categorization)
    {
        return mb_strtolower($entry->text) === mb_strtolower($categorization->search);
    }

    /**
     * Check if the amount match between the journal entry and the categorization
     *
     * @param  \Gallib\Macope\App\JournalEntry   $entry
     * @param  \Gallib\Macope\App\Categorization $categorization
     * @return boolean
     */
    protected function checkAmount(JournalEntry $entry, Categorization $categorization)
    {
        if ($categorization->amount === null) {
            return true;
        }

        return $categorization->amount == $entry->{$categorization->entry_type};
    }

    /**
     * Check if the given entry match with the categorization entry type
     *
     * @param  \Gallib\Macope\App\JournalEntry   $entry
     * @param  \Gallib\Macope\App\Categorization $categorization
     * @return boolean
     */
    protected function checkEntryType(JournalEntry $entry, Categorization $categorization)
    {
        return $entry->{$categorization->entry_type} !== null;
    }
}
