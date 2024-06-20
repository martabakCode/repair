<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use App\Models\Divisi;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    public function index()
    {
        $mesins = Mesin::with('divisi')->get();
        $spareparts = Sparepart::all();
        return view('mesin.index', compact('mesins','spareparts'));
    }

    public function create()
    {
        $divisis = Divisi::all();
        return view('mesin.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_mesin' => 'required|unique:mesin,id_mesin',
            'nama_mesin' => 'required',
            'merk_mesin' => 'required',
            'kapasitas' => 'required',
            'id_divisi' => 'required',
            'tahun_pembuatan' => 'required|integer',
            'periode_pakai' => 'required|integer',
        ]);

        Mesin::create($request->all());

        return redirect()->route('mesin.index')
                         ->with('success', 'Mesin created successfully.');
    }

    public function show($id)
    {
        $mesin = Mesin::with('divisi')->findOrFail($id);
        return view('mesin.show', compact('mesin'));
    }

    public function edit($id)
    {
        $mesin = Mesin::where('id_mesin',$id)->first();
        $divisis = Divisi::all();
        return view('mesin.edit', compact('mesin', 'divisis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mesin' => 'required',
            'merk_mesin' => 'required',
            'kapasitas' => 'required',
            'id_divisi' => 'required',
            'tahun_pembuatan' => 'required|integer',
            'periode_pakai' => 'required|integer',
        ]);

        $mesin = Mesin::findOrFail($id);
        $mesin->update($request->all());

        return redirect()->route('mesin.index')
                         ->with('success', 'Mesin updated successfully.');
    }

    public function destroy($id)
    {
        $mesin = Mesin::findOrFail($id);
        $mesin->delete();

        return redirect()->route('mesin.index')
                         ->with('success', 'Mesin deleted successfully.');
    }
}
