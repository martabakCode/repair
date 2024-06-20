<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeknisiController extends Controller
{
    public function index()
    {
        $teknisis = User::where('level', 'teknisi')->get();
        return view('teknisi.index', compact('teknisis'));
    }

    public function create()
    {
        $divisis = Divisi::all();
        return view('teknisi.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|unique:user',
            'nama_user' => 'required|unique:user',
            'nama_lengkap' => 'required',
            'password' => 'required|min:6',
            'id_divisi' => 'required',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['level'] = 'teknisi';

        User::create($data);

        return redirect()->route('teknisi.index')
            ->with('success', 'Teknisi created successfully');
    }

    public function show($id)
    {
        $teknisi = User::findOrFail($id);
        $teknisi->status_akun = ($teknisi->status_akun == 'Aktif') ? 'Nonaktif' : 'Aktif'; // Toggle status// Assuming 'status' is a column in your users table
        $teknisi->save();

        return redirect()->route('teknisi.index')->with('success', 'Teknisi status updated successfully!');
    }

    public function edit($id)
    {
        $teknisi = User::findOrFail($id);
        $divisis = Divisi::all();
        return view('teknisi.edit', compact('teknisi', 'divisis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'id_divisi' => 'required',
        ]);

        $teknisi = User::findOrFail($id);
        $teknisi->update($request->all());

        return redirect()->route('teknisi.index')
            ->with('success', 'Teknisi updated successfully');
    }

    public function destroy($id)
    {
        $teknisi = User::findOrFail($id);
        $teknisi->delete();

        return redirect()->route('teknisi.index')
            ->with('success', 'Teknisi deleted successfully');
    }
}
