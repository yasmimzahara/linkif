<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Internship;
use App\Models\Application;
use App\Models\Student;
use App\Mail\Student\ApplyToInternship;
use Illuminate\Support\Facades\Mail;

class InternshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $internships = $this->indexInternships();

        return view('student.internships.index', compact('internships'))
                  ->with('page', request()->input('page', 1));
    }

    private function indexInternships()
    {
        return Internship::with('company')
                ->join('users as companies', 'companies.id', '=', 'internships.company_id')
                ->where('course_id', $this->currentStudentCourseId())
                ->when(request()->my_internships_only, function($query) {
                    $query->whereIn($this->currentStudentId(), \DB::table('applications')->whereColumn('applications.internship_id', 'internships.id')->select('student_id'));
                })
                ->when(request()->available_only, function($query) {
                    $query->whereNotIn($this->currentStudentId(), \DB::table('applications')->whereColumn('applications.internship_id', 'internships.id')->select('student_id'))
                          ->where('expires_at', '>', new \DateTime());
                })
                ->select('internships.*')
                ->addSelect(\DB::raw("{$this->currentStudentId()} IN (SELECT student_id FROM applications WHERE applications.internship_id = internships.id) as has_application"))
                ->distinct()
                ->orderBy('created_at', 'desc')
                ->search(request()->input())
                ->paginate(5);
    }

    private function currentStudentId()
    {
        return \Auth::user()->id;
    }

    private function currentStudentCourseId()
    {
        return Student::find($this->currentStudentId())->info->course_id;
    }

    public function apply(Internship $internship)
    {
        $application = Application::firstOrCreate([
            'student_id' => $this->currentStudentId(),
            'internship_id' => $internship->id,
        ]);

        Mail::to($internship->company)->send(new ApplyToInternship($application->id));

        return redirect()
                  ->route('student.internships.index')
                  ->with('message', 'Candidatura criada com sucesso');
    }
}
