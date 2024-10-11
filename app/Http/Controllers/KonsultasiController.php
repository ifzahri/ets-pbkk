<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function create()
    {
        $dokters = Dokter::all();
        return view('konsultasis.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        Konsultasi::create([
            'dokter_id' => $request->dokter_id,
            'pasien_id' => Auth::user()->pasien->id,
            'keluhan' => $request->keluhan,
            'tanggal_keluhan' => $request->tanggal_keluhan,
            'status' => 'pending',
        ]);

        return redirect()->route('konsultasi.index');
    }

    public function index()
    {
        $pasien = Auth::user()->pasien;

        if (!$pasien) {
            return redirect()->back()->with('error', 'No patient record found for this user.');
        }

        $konsultasis = Konsultasi::where('pasien_id', $pasien->id)->get();
        $dokters = Dokter::all();

        return view('pasien.index', compact('pasien', 'konsultasis', 'dokters'));
    }

    public function destroy($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();

        return redirect()->route('konsultasi.index')->with('success', 'Konsultasi deleted successfully.');
    }
}
