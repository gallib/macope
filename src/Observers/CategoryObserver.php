<?php

namespace Gallib\Macope\Observers;

use Gallib\Macope\Category;
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
     * @param  \Gallib\Macope\Category $category
     * @return void
     */
    public function saving(Category $category)
    {
        $category->is_ignored = $this->request->input('is_ignored', 0);
    }
}
