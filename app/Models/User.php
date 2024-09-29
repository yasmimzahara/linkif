<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'student_id');
    }

    public function resume(): HasOne
    {
        return $this->hasOne(Resume::class, 'student_id');
    }

    public function info(): HasOne
    {
        if ($this->type == 'student') {
            return $this->hasOne(StudentInfo::class, 'student_id');
        } elseif ($this->type == 'company') {
            return $this->hasOne(CompanyInfo::class, 'company_id');
        }
    }

    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class, 'company_id');
    }
}
