<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\Searchable;

class Internship extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'requirements',
        'integration_agency',
        'course_id',
        'title',
        'workload',
        'shift',
        'description',
        'wage',
        'address_id',
        'company_id',
    ];

    protected $searchableBy = [
      'title' => ['title'],
      'company_name' => ['companies.name'],
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function Company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    public function isTooOld(): bool
    {
        return $this->expires_at < new \DateTime();
    }
}
