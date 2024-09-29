<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use File;
use PDF;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'student_id',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function toPdf()
    {
        $path = sys_get_temp_dir() . "/student-resume-" . $this->id . ".pdf";
        File::delete($path);

        PDF::loadView('student.resumes.pdf', ['resume' => $this])->save($path);

        return $path;
    }
}
