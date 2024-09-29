<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Student\ResumeUpdateRequest;
use App\Models\Resume;

class ResumesController extends Controller
{
    public function edit()
    {
        $resume = $this->currentStudentResume();

        return view('student.resumes.edit', compact('resume'));
    }

    public function download()
    {
        $pdf = request()->user()->resume->toPdf();

        return response()->download($pdf);
    }

    public function update(ResumeUpdateRequest $request)
    {
        $resume = $this->currentStudentResume();
        $resume->update($request->validated());

        return redirect()
                  ->route('dashboard')
                  ->with('message', 'Currículo editado com sucesso');
    }

    private function currentStudentResume()
    {
        return Resume::where('student_id', \Auth::user()->id)->first();
    }
}
