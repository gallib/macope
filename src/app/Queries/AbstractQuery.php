<?php

namespace Gallib\Macope\App\Queries;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractQuery
{
    /**
     * @var \Illuminate\Container\Container
     */
    protected $app;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new Query instance
     *
     * @param \Illuminate\Container\Container $app
     * @return  void
     */
    public function __construct(App $app)
    {
        $this->app = $app;

        $this->makeModel();
    }

    /**
     * Specify the model class name
     *
     * @return  mixed
     */
    abstract protected function modelClassName();

    /**
     * Make model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function makeModel() {
        $model = $this->app->make($this->modelClassName());

        if (!$model instanceof Model)
            throw new QueryException("Class {$this->modelClassName()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        $this->model = $model;

        return $this->model;
    }
}