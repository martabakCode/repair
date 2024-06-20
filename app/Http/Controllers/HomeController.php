<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perbaikan;
use App\Models\User;
use App\Models\Sparepart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $perbaikans = Perbaikan::with('mesin','sparepart')->get();
        $teknisis = User::where('level','teknisi')->get();
        $spareparts = Sparepart::all();
        return view('home', compact('perbaikans','teknisis', 'spareparts'));
    }
}
