<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\Searchable;

class Course extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
    ];

    protected $searchableBy = [
      'name' => ['name'],
    ];

    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class);
    }
}
