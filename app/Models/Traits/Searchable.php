<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $query, array $params): void
    {
        $searchableBy = $this->searchableBy;

        foreach ($searchableBy as $paramName => $columns) {
            $query->where(function($q) use ($searchableBy, $columns, $paramName, $params) {
                foreach ($columns as $column) {
                    $value = \Arr::get($params, $paramName);

                    if ($value) {
                        $q->orWhere($column, 'like', "%$value%");
                    }
                }
            });
        }
    }
}
