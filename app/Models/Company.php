<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\Searchable;

class Company extends User
{
    use Searchable;

    protected $table = 'users';

    protected $attributes = [
        'type' => 'company',
    ];

    protected $searchableBy = [
      'search' => ['name', 'email'],
    ];

    protected $with = ['info.address'];

    protected static function booted(): void
    {
        static::addGlobalScope('company', function (Builder $builder) {
            $builder->where('type', 'company');
        });
    }

    public function info(): HasOne
    {
        return $this->hasOne(CompanyInfo::class);
    }
}
