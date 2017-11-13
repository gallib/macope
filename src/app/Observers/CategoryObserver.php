<?php

namespace Gallib\Macope\App\Observers;

use Gallib\Macope\App\Category;
use Gallib\Macope\App\Services\CategorizationService;
use Illuminate\Http\Request;

class CategoryObserver
{
    /**
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new observer instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Listen to the Category saving event.
     *
     * @param  \Gallib\Macope\App\Category $category
     * @return void
     */
    public function saving(Category $category)
    {
        $category->is_ignored = $this->request->input('is_ignored', 0);
    }
}
