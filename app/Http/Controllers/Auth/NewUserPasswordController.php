<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\NewUserPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class NewUserPasswordController extends Controller
{
    public function create(User $user)
    {
        if ($user->password != '' || $user->remember_token != request()->token) {
            dd($user->password);
            abort(403);
        }

        return view('auth.new-user-password', compact('user'));
    }

    public function store(User $user, NewUserPasswordRequest $request)
    {
        if ($user->password != '' || $user->remember_token != request()->token) {
            abort(403);
        }

        $user->fill([
            'password' => Hash::make($request->password),
            'remember_token' => null,
        ])->save();

        \Auth::login($user);

        return redirect()->route('dashboard');
    }
}
