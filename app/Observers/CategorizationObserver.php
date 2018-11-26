<?php

namespace App\Observers;

use App\Categorization;
use App\Services\CategorizationService;

class CategorizationObserver
{
    /**
     * @var \App\Service\CategorizationService
     */
    protected $categorizationService;

    /**
     * Create a new observer instance.
     *
     * @return void
     */
    public function __construct(CategorizationService $categorizationService)
    {
        $this->categorizationService = $categorizationService;
    }

    /**
     * Listen to the Categorization created event.
     *
     * @param  \App\Categorization $categorization
     * @return void
     */
    public function created(Categorization $categorization)
    {
        $this->categorizationService->applyCategorization($categorization);
    }

    /**
     * Listen to the Categorization updated event.
     *
     * @param  \App\Categorization $categorization
     * @return void
     */
    public function updated(Categorization $categorization)
    {
        $this->categorizationService->applyCategorization($categorization);
    }
}
