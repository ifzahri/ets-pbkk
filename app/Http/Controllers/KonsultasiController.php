<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Konsultasi;
use Illuminate\Http\Request;

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
            'pasien_id' => auth()->user()->id,
            'keluhan' => $request->keluhan,
            'tanggal_keluhan' => $request->tanggal_keluhan,
            'status' => $request->status
        ]);

        return redirect()->route('konsultasis.index');
    }

    public function index()
    {
        $pasien = auth()->user()->pasien;

        if (!$pasien) {
            return redirect()->back()->with('error', 'No pasien record found for this user.');
        }

        $konsultasis = Konsultasi::where('pasien_id', $pasien->id)->get();
        return view('konsultasis.index', compact('konsultasis'));
    }

    public function accept($id)
    {
        $konsultasi = Konsultasi::find($id);
        $konsultasi->update(['status' => 'diterima']);

        return back();
    }

    public function deny($id)
    {
        $konsultasi = Konsultasi::find($id);
        $konsultasi->update(['status' => 'ditolak']);

        return back();
    }
}
