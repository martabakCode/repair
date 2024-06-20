<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('divisi')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $divisis = Divisi::all();
        return view('users.create',compact('divisis'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'id_user' => 'required|unique:user',
            'nama_user' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'id_divisi' => 'required|string|max:10',
            'level' => 'required|in:admin,user,teknisi',
        ]);

        // Create new user
        User::create($request->all());

        return redirect()->route('users.index')
                         ->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $teknisi = User::findOrFail($id);
        $teknisi->status_akun = ($teknisi->status_akun == 'Aktif') ? 'Nonaktif' : 'Aktif'; // Toggle status// Assuming 'status' is a column in your users table
        $teknisi->save();

        return redirect()->route('users.index')->with('success', 'User status updated successfully!');
    }

    public function edit($id)
    {
        $divisis = Divisi::all();
        $user = User::findOrFail($id);
        return view('users.edit', compact('user','divisis'));
    }

    public function update(Request $request, $id)
    {

        // Validate the request
        $request->validate([
            'id_user' => 'unique:user',
            'nama_user' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'id_divisi' => 'required|string|max:10',
            'level' => 'required|in:admin,user,teknisi',
        ]);
        $user = User::findOrFail($id);
        $user->nama_user = $request->nama_user;
        $user->id_divisi = $request->id_divisi;
        $user->level = $request->level;

        // Check if password is provided and update it if it's not empty
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Encrypt the password if provided
        }

        $user->save();

        return redirect()->route('users.index')
                         ->with('success', 'User updated successfully.');

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'User deleted successfully.');
    }
}

