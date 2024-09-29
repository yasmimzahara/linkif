<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseStoreRequest;
use App\Http\Requests\Admin\CourseUpdateRequest;
use App\Models\Course;
use App\Models\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::search(request()->input())->paginate();

        return view('admin.courses.index', compact('courses'))
                  ->with('page', request()->input('page', 1));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStoreRequest $request)
    {
        Course::create($request->validated());

        return redirect()
                  ->route('admin.courses.index')
                  ->with('message', 'Curso criado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect()
                  ->route('admin.courses.index')
                  ->with('message', 'Curso editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        DB::transaction(function() use ($course) {
            foreach ($course->internships as $internship) {
                $internship->applications()->delete();
            }
            $course->internships()->delete();
            $studentInfos = StudentInfo::where('course_id', '=', $course->id)->get();
            foreach ($studentInfos as $info) {
                $info->student->resume()->delete();
                $info->student->applications()->delete();
                DB::table('sessions')->where('user_id', '=', $info->student->id)->delete();
                $info->delete();
                $info->student->delete();
            }
            $course->delete();
        });

        return redirect()
                ->route('admin.courses.index')
                ->with('message', 'Curso deletado com sucesso');
    }
}
