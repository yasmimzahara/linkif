<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApplicationStoreRequest;
use App\Http\Requests\Admin\ApplicationUpdateRequest;
use App\Models\Application;
use App\Models\Student;
use App\Models\Internship;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $applications = Application::join('users as students', 'applications.student_id', '=', 'students.id')
            ->join('internships', 'applications.internship_id', '=', 'internships.id')
            ->join('users as companies', 'internships.company_id', '=', 'companies.id')
            ->select('applications.*')
            ->search(request()->input())->paginate();

        return view('admin.applications.index', compact('applications'))
                  ->with('page', request()->input('page', 1));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::pluck('name', 'id');
        $internships = Internship::pluck('title', 'id');

        return view('admin.applications.create', compact('students', 'internships'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplicationStoreRequest $request)
    {
        Application::create($request->validated());

        return redirect()
                  ->route('admin.applications.index')
                  ->with('message', 'Candidatura criada com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        $students = Student::pluck('name', 'id');
        $internships = Internship::pluck('title', 'id');

        return view('admin.applications.edit', compact('application', 'students', 'internships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApplicationUpdateRequest $request, Application $application)
    {
        $application->update($request->validated());

        return redirect()
                  ->route('admin.applications.index')
                  ->with('message', 'Candidatura editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
      $application->delete();

      return redirect()
                ->route('admin.applications.index')
                ->with('message', 'Candidatura deletada com sucesso');
    }
}
