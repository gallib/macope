<?php

namespace Gallib\Macope\App\Observers;

use Gallib\Macope\App\Categorization;
use Gallib\Macope\App\Services\CategorizationService;

class CategorizationObserver
{
    /**
     * @var \Gallib\Macope\App\Service\CategorizationService
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
     * @param  \Gallib\Macope\App\Categorization $categorization
     * @return void
     */
    public function created(Categorization $categorization)
    {
        $this->categorizationService->applyCategorization($categorization);
    }

    /**
     * Listen to the Categorization updated event.
     *
     * @param  \Gallib\Macope\App\Categorization $categorization
     * @return void
     */
    public function updated(Categorization $categorization)
    {
        $this->categorizationService->applyCategorization($categorization);
    }
}
