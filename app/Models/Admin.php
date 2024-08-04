<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\Searchable;

class Admin extends User
{
    use Searchable;

    protected $table = 'users';

    protected $attributes = [
        'type' => 'admin',
    ];

    protected $searchableBy = [
      'search' => ['name', 'email'],
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('admin', function (Builder $builder) {
            $builder->where('type', 'admin');
        });
    }
}
