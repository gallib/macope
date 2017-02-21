<?php

namespace Gallib\Macope\App\Categorize;

use Gallib\Macope\App\Categorization;
use Gallib\Macope\App\JournalEntry;

class Categorizer
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $categorizations;

    public function __construct()
    {
        $this->categorizations = Categorization::all();
    }

    /**
     * Try to categorize the given journal entry

     * @param  \Gallib\Macope\App\JournalEntry $entry
     * @return void
     */
    public function categorize(JournalEntry $entry)
    {
        foreach ($this->categorizations as $categorization) {
            if (!method_exists($this, $categorization->type)) {
                throw new \Exception("$categorization->type is not a valid categorization type");
            }

            if ($this->{$categorization->type}($entry, $categorization)) {
                $entry->category_id = $categorization->category_id;

                break;
            }
        }
    }

    /**
     * Check if the categorization contains is found the journal entry
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
}
