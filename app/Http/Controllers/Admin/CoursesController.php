<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseStoreRequest;
use App\Http\Requests\Admin\CourseUpdateRequest;
use App\Models\Course;
use Illuminate\Http\Request;

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
      $course->delete();

      return redirect()
                ->route('admin.courses.index')
                ->with('message', 'Curso deletado com sucesso');
    }
}
