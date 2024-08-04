<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Http\Requests\Admin\UserUpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::search(request()->input())->paginate();

        return view('admin.admins.index', compact('admins'))
                  ->with('page', request()->input('page', 1));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreRequest $request)
    {
        Admin::create($request->validated() + [
            'password' => Hash::make($request->password),
        ] + $request->validated());

        return redirect()
                  ->route('admin.admins.index')
                  ->with('message', 'Admin criado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        $admin->update($request->validated());

        return redirect()
                  ->route('admin.admins.index')
                  ->with('message', 'Admin editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
      $admin->delete();

      return redirect()
                ->route('admin.admins.index')
                ->with('message', 'Admin deletado com sucesso');
    }

    public function editPassword(Admin $admin)
    {
        return view('admin.admins.edit-password', compact('admin'));
    }

    public function updatePassword(UserUpdatePasswordRequest $request, Admin $admin)
    {
        $admin->update(['password' => Hash::make($request->password)]);

        return redirect()
                  ->route('admin.admins.index')
                  ->with('message', 'Senha alterada com sucesso');
    }
}
