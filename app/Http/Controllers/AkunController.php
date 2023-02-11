<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        return view('setting.akun', [
            'user' => User::all(),
        ]);
    }
    public function save(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $validate['password'] = Hash::make($validate['password']);
        User::create($validate);

        return back();
    }
    public function update(Request $request, $id)
    {
        $up_user = user::find($id);
        $input = $request->all();
        $up_user->fill($input)->save();

        return back();
    }

    public function delete($id)
    {
        $del_user = user::find($id);
        $del_user->delete();

        return back();
    }
    public function role($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('setting.role', compact('roles', 'user'));
    }
    public function assignRole(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }
        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    public function deleteRole($user, $role)
    {
        $user = User::find($user);
        $role = Role::find($role);
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->withErrors('message', 'Role removed.');
        }
        return back()->withErrors('message', 'Role not exists.');
    }
}
