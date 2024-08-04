<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InternshipStoreRequest;
use App\Http\Requests\Admin\InternshipUpdateRequest;
use App\Models\Company;
use App\Models\Internship;
use App\Models\Superintendent;
use App\Models\Course;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InternshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $internships = Internship::join('users as companies', 'internships.company_id', '=', 'companies.id')
            ->select('internships.*')
            ->search(request()->input())
            ->paginate();

        return view('admin.internships.index', compact('internships'))
                  ->with('page', request()->input('page', 1));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        return view('admin.internships.create', compact('courses', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InternshipStoreRequest $request)
    {
        DB::transaction(function() use ($request) {
            $address = Address::create($request->validated()['address']);
            $internship = Internship::create($request->validated() + [ 'address_id' => $address->id ]);
        });

        return redirect()
                  ->route('admin.internships.index')
                  ->with('message', 'Vaga criada com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Internship $internship)
    {
        $courses = Course::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        return view('admin.internships.edit', compact('internship', 'courses', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InternshipUpdateRequest $request, Internship $internship)
    {
        DB::transaction(function() use ($request, $internship) {
            $internship->update($request->validated());
            $internship->address->update($request->validated()['address']);
        });

        return redirect()
                  ->route('admin.internships.index')
                  ->with('message', 'Vaga editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Internship $internship)
    {
        DB::transaction(function() use ($internship) {
            $internship->delete();
            $internship->address->delete();
        });

        return redirect()
                  ->route('admin.internships.index')
                  ->with('message', 'Vaga deletada com sucesso');
    }
}
