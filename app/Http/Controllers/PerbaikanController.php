<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perbaikan;
use App\Models\User;
use App\Models\Sparepart;
use Carbon\Carbon;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikans = Perbaikan::with('mesin','sparepart')->get();
        $teknisis = User::where('level','teknisi')->get();
        $spareparts = Sparepart::all();
        return view('perbaikan.index', compact('perbaikans','teknisis', 'spareparts'));
    }

    public function create()
    {
        // Tampilkan form tambah perbaikan
        return view('perbaikan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tgl_buat' => 'required|date',
            'id_mesin' => 'required',
            'id_user' => 'required',
            'judul' => 'required',
            'keterangan' => 'required',
            'id_teknisi' => 'required',
            'status' => 'required',
        ]);

        // Simpan data perbaikan baru
        Perbaikan::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('perbaikan.index')
                         ->with('success', 'Perbaikan created successfully.');
    }

    public function show($id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        return view('perbaikan.show', compact('perbaikan'));
    }

    public function edit($id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        return view('perbaikan.edit', compact('perbaikan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tgl_buat' => 'required|date',
            'id_mesin' => 'required',
            'id_user' => 'required',
            'judul' => 'required',
            'keterangan' => 'required',
            'id_teknisi' => 'required',
            'status' => 'required',
        ]);

        // Update data perbaikan
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('perbaikan.index')
                         ->with('success', 'Perbaikan updated successfully.');
    }

    public function destroy($id)
    {
        // Hapus data perbaikan
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('perbaikan.index')
                         ->with('success', 'Perbaikan deleted successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);

        if ($perbaikan->status == 'Open') {
            $request->validate([
                'id_teknisi' => 'required',
            ]);

            $request['status'] = 'Waiting';

            $perbaikan->update($request->all());

            // Redirect dengan pesan sukses
            return redirect()->route('perbaikan.index')
                             ->with('success', 'Perbaikan updated successfully.');
        } elseif ($perbaikan->status == 'Waiting') {
            $request->validate([
                'id_sparepart' => 'required'
            ]);


            $request['status'] = 'Closed';

            $perbaikan->update($request->all());

            // Redirect dengan pesan sukses
            return redirect()->route('perbaikan.index')
                             ->with('success', 'Perbaikan updated successfully.');
        } elseif ($request->status == 'Close') {
            // Handle 'Close' status
            $perbaikan->status = 'Selesai';
            $perbaikan->save();
            return redirect()->route('perbaikan.index')->with('success', 'Perbaikan selesai.');
        }
    }
    public function indexLaporan(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal ? Carbon::parse($request->tanggal_awal)->toDateString() : null;
        $tanggal_akhir = $request->tanggal_akhir ? Carbon::parse($request->tanggal_akhir)->toDateString() : null;

        $query = Perbaikan::where('status', 'Closed');

        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('tgl_buat', [$tanggal_awal, $tanggal_akhir]);
        } else {
            // Jika tidak ada rentang tanggal yang dipilih, tampilkan semua data
            $query->orderBy('tgl_buat', 'desc');
        }

        $perbaikans = $query->get();

        return view('perbaikan.indexLaporan', compact('perbaikans', 'tanggal_awal', 'tanggal_akhir'));
    }
}
