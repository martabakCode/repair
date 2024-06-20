<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mesin;
use App\Models\Perbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikans = Perbaikan::select('id_perbaikan', 'tgl_buat', 'id_user', 'id_mesin', 'judul', 'status', 'keterangan')
            ->where('id_user',Auth::id())
            ->orderBy('tgl_buat', 'desc')
            ->get();

        return view('users.perbaikan.index', compact('perbaikans'));
    }
    public function create()
    {
        $lastPerbaikan = Perbaikan::orderBy('id_perbaikan','desc')->first();

        // Increment the last ID to generate a new ID
        $lastId = $lastPerbaikan ? (int) substr($lastPerbaikan->id_perbaikan, 2) : 0;

        $newId = 'TC' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $idMesins = Mesin::all();
        return view('users.perbaikan.create', compact('idMesins','newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_buat' => 'required|date',
            'id_mesin' => 'required',
            'judul' => 'required|string',
        ]);

        // Create new perbaikan
        $perbaikan = new Perbaikan();
        $perbaikan->id_user = Auth::id();
        $perbaikan->id_perbaikan = $request->id_perbaikan;
        $perbaikan->tgl_buat = $request->tgl_buat;
        $perbaikan->id_mesin = $request->id_mesin;
        $perbaikan->judul = $request->judul;
        $perbaikan->save();

        return redirect()->route('user.perbaikan.index')->with('success', 'Perbaikan added successfully.');
    }
}
