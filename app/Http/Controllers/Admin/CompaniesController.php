<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyStoreRequest;
use App\Http\Requests\Admin\CompanyUpdateRequest;
use App\Http\Requests\Admin\UserUpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\CompanyInfo;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::search(request()->input())->paginate();

        return view('admin.companies.index', compact('companies'))
                  ->with('page', request()->input('page', 1));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyStoreRequest $request)
    {
        DB::transaction(function() use ($request) {
            $address = Address::create($request->validated()['info']['address']);
            $company = Company::create($request->validated() + [
                'password' => Hash::make($request->password),
            ] + $request->validated());
            CompanyInfo::create([
                'address_id' => $address->id,
                'company_id' => $company->id,
            ] + $request->validated()['info']);
        });

        return redirect()
                  ->route('admin.companies.index')
                  ->with('message', 'Empresa criada com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        DB::transaction(function() use ($request, $company) {
            $company->update($request->validated());
            $company->info->update($request->validated()['info']);
            $company->companyinfo->address->update($request->validated()['info']['address']);
        });

        return redirect()
                  ->route('admin.companies.index')
                  ->with('message', 'Empresa editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        DB::transaction(function() use ($company) {
            $company->info->delete();
            $company->info->address->delete();
            $company->delete();
        });

      return redirect()
                ->route('admin.companies.index')
                ->with('message', 'Empresa deletada com sucesso');
    }

    public function editPassword(Company $company)
    {
        return view('admin.companies.edit-password', compact('company'));
    }

    public function updatePassword(UserUpdatePasswordRequest $request, Company $company)
    {
        $company->update(['password' => Hash::make($request->password)]);

        return redirect()
                  ->route('admin.companies.index')
                  ->with('message', 'Senha alterada com sucesso');
    }
}
