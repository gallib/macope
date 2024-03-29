<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait Hashable
{
    /**
     * Generate a hash based on model values.
     *
     * @return string
     */
    public function generateHash()
    {
        return $this->getHashByAttributes($this->toArray());
    }

    /**
     * Get the hash for given attributes.
     *
     * @param  array  $attributes
     * @return string
     */
    protected function getHashByAttributes(array $attributes)
    {
        if (! property_exists($this, 'hashWith') || ! is_array($this->hashWith)) {
            $this->hashWith = [];
        }

        $filtered = array_intersect_key($attributes, array_flip($this->hashWith));

        return md5(json_encode($filtered));
    }

    /**
     * find a model by its hash or create a new instance.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  array  $attributes
     * @return mixed
     */
    public function scopeFindByHashOrCreate(Builder $query, array $attributes)
    {
        $hash = $this->getHashByAttributes($attributes);

        $query->where(['hash' => $hash]);

        if (Arr::exists($attributes, 'batch')) {
            $query->where('batch', '<>', $attributes['batch']);
        }

        if (! is_null($instance = $query->first())) {
            return $instance;
        }

        return tap($this->newModelInstance($attributes), function ($instance) {
            $instance->save();
        });
    }
}
