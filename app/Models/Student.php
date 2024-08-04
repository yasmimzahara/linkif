<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Traits\Searchable;

class Student extends User
{
    use Searchable;

    protected $table = 'users';

    protected $attributes = [
        'type' => 'student',
    ];

    protected $searchableBy = [
      'search' => ['name', 'email'],
    ];

    protected $with = ['resume', 'info'];

    protected static function booted(): void
    {
        static::addGlobalScope('student', function (Builder $builder) {
            $builder->where('type', 'student');
        });
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function resume(): HasOne
    {
        return $this->hasOne(Resume::class);
    }

    public function info(): HasOne
    {
        return $this->hasOne(StudentInfo::class);
    }
}
