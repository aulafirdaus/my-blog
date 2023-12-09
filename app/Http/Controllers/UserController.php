<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::query()
            ->whereNotNull('email_verified_at')
            ->whereNot('id', $request->user()->id)
            // ->with('roles')
            ->latest()
            ->paginate(10);
        return view('users.index',[
            'users' => $users,
        ]);
    }

    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
            'articles' => $user->articles()->latest()->paginate(9),
        ]);
    }

    public function edit(Request $request)
    {
        return view('users.edit', [
            'user' => $request->user(),
        ]);
    }
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:191'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($request->user())],
            'username' => ['required', 'string', 'min:3', 'max:25', 'alpha_num',
                Rule::unique('users', 'email')->ignore($request->user())
            ],
        ]);

        $request->user()->update($attributes);
        return to_route('users.show', $request->user());
    }
}
