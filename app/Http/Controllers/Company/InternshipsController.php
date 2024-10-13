<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\InternshipStoreRequest;
use App\Http\Requests\Company\InternshipUpdateRequest;
use App\Models\Company;
use App\Models\Internship;
use App\Models\Course;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InternshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $internships = $this->currentCompany()->internships()
                            ->orderBy('created_at', 'desc')
                            ->search(request()->input())
                            ->paginate();

        return view('company.internships.index', compact('internships'))
                  ->with('page', request()->input('page', 1));
    }

    private function currentCompany()
    {
        return Company::find(\Auth::id());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Internship::class);

        $courses = Course::pluck('name', 'id');

        return view('company.internships.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InternshipStoreRequest $request)
    {
        Gate::authorize('create', Internship::class);

        DB::transaction(function() use ($request) {
            $address = Address::create($request->validated()['address']);
            $internship = new Internship;
            $internship->setExpiresAtDateAttribute($request->expires_at_date);
            $internship->setExpiresAtTimeAttribute($request->expires_at_time);
            $internship->fill([
                'address_id' => $address->id,
                'company_id' => \Auth::id(),
            ] + $request->validated());
            $internship->save();
        });

        return redirect()
                  ->route('company.internships.index')
                  ->with('message', 'Vaga criada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Internship $internship)
    {
        Gate::authorize('view', $internship);

        $applications = $internship->applications()
                                   ->join('users as students', 'applications.student_id', '=', 'students.id')
                                   ->search(request()->input())
                                   ->paginate(5);

        return view('company.internships.show', compact('internship', 'applications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Internship $internship)
    {
        Gate::authorize('update', $internship);

        $courses = Course::pluck('name', 'id');

        return view('company.internships.edit', compact('internship', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InternshipUpdateRequest $request, Internship $internship)
    {
        Gate::authorize('update', $internship);

        DB::transaction(function() use ($request, $internship) {
            $internship->setExpiresAtDateAttribute($request->expires_at_date);
            $internship->setExpiresAtTimeAttribute($request->expires_at_time);
            $internship->update($request->validated());
            $internship->address->update($request->validated()['address']);
        });

        return redirect()
                  ->route('company.internships.show', [$internship->id])
                  ->with('message', 'Vaga editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Internship $internship)
    {
        Gate::authorize('delete', $internship);

        DB::transaction(function() use ($internship) {
            $internship->applications()->delete();
            $internship->delete();
            $internship->address->delete();
        });

        return redirect()
                  ->route('company.internships.index')
                  ->with('message', 'Vaga deletada com sucesso');
    }
}
