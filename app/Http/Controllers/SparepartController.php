<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Divisi;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::all();
        return view('sparepart.index', compact('spareparts'));
    }

    public function create()
    {
        $divisis = Divisi::all();
        return view('sparepart.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sparepart' => 'required|unique:spareparts',
            'nama_sparepart' => 'required',
            'merk_sparepart' => 'required',
            'id_divisi' => 'required',
        ]);

        Sparepart::create($request->all());

        return redirect()->route('mesin.index')
            ->with('success', 'Sparepart created successfully');
    }

    public function show($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        return view('sparepart.show', compact('sparepart'));
    }

    public function edit($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $divisis = Divisi::all();
        return view('sparepart.edit', compact('sparepart', 'divisis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sparepart' => 'required',
            'merk_sparepart' => 'required',
            'id_divisi' => 'required',
        ]);

        $sparepart = Sparepart::findOrFail($id);
        $sparepart->update($request->all());

        return redirect()->route('mesin.index')
            ->with('success', 'Sparepart updated successfully');
    }

    public function destroy($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $sparepart->delete();

        return redirect()->route('mesin.index')
            ->with('success', 'Sparepart deleted successfully');
    }
}
