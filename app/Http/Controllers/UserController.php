<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        $users = User::all();

        return view('users.list', [
            'users' => $users
        ]);
    }
    public function single($id)
    {
        $user = User::findOrFail($id);
        return view('users.single', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        return view('users.update', [
            'user' => $user
        ]);
    }

    public function updateSubmit(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,editor,registered',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['full_name', 'email', 'role']));

        return redirect()->route('admin.users.list')->with('success', 'Korisnik je uspešno izmenjen.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.list')->with('success', 'Korisnik je obrisan.');
    }
}
