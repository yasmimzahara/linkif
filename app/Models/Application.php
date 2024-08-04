<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\Searchable;

class Application extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'student_id',
        'internship_id',
    ];

    protected $searchableBy = [
      'student_name' => ['students.name'],
      'internship_title' => ['internships.title'],
      'company_name' => ['companies.name'],
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class);
    }
}
