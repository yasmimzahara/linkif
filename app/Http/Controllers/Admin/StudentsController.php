<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentStoreRequest;
use App\Http\Requests\Admin\StudentUpdateRequest;
use App\Http\Requests\Admin\UserUpdatePasswordRequest;
use App\Mail\Auth\NewUserPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\StudentInfo;
use App\Models\Resume;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::search(request()->input())->paginate();

        return view('admin.students.index', compact('students'))
                  ->with('page', request()->input('page', 1));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::pluck('name', 'id');

        return view('admin.students.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $student = new Student($request->validated());
            $rememberToken = Str::random(60);
            $student->setRawAttributes($student->getAttributes() + [
                'password' => '',
                'remember_token' => $rememberToken,
            ]);
            $student->save();

            Resume::create(
                array_filter(
                    ['student_id' => $student->id] + $request->validated()['resume']
                )
            );
            StudentInfo::create([
                'student_id' => $student->id,
            ] + $request->validated()['info']);

            Mail::to($student)->send(new NewUserPassword($student->id, $rememberToken));
        });

        return redirect()
                  ->route('admin.students.index')
                  ->with('message', 'Estudante criado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $courses = Course::pluck('name', 'id');

        return view('admin.students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        DB::transaction(function () use ($request, $student) {
            $student->info->update($request->validated()['info']);
            $student->resume->update(
                array_filter($request->validated()['resume'])
            );
            $student->update($request->validated());
        });

        return redirect()
                  ->route('admin.students.index')
                  ->with('message', 'Estudante editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {
            DB::table('sessions')->where('user_id', '=', $student->id)->delete();
            $student->applications()->delete();
            $student->resume()->delete();
            $student->info()->delete();
            $student->delete();
        });

      return redirect()
                ->route('admin.students.index')
                ->with('message', 'Estudante deletado com sucesso');
    }

    public function editPassword(Student $student)
    {
        return view('admin.students.edit-password', compact('student'));
    }

    public function updatePassword(UserUpdatePasswordRequest $request, Student $student)
    {
        $student->update(['password' => Hash::make($request->password)]);

        return redirect()
                  ->route('admin.students.index')
                  ->with('message', 'Senha alterada com sucesso');
    }
}
