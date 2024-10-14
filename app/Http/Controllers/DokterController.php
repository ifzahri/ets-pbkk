<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Konsultasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::where('email', Auth::user()->email)->firstOrFail();
        
        $konsultasis = Konsultasi::where('dokter_id', $dokter->id)
            ->with('pasien')
            ->paginate(10);
    
        return view('dokter.index', compact('dokter', 'konsultasis'));
    }
    
    public function show($id)
    {
        $dokter = Dokter::where('email', Auth::user()->email)->firstOrFail();
        
        $konsultasi = Konsultasi::where('id', $id)
            ->where('dokter_id', $dokter->id)
            ->with('pasien')
            ->firstOrFail();
        
        return view('dokter.show', compact('dokter', 'konsultasi'));
    }

    public function addMedication(Request $request, $id)
{
    $dokter = Dokter::where('email', Auth::user()->email)->firstOrFail();
    
    $konsultasi = Konsultasi::where('id', $id)
        ->where('dokter_id', $dokter->id)
        ->firstOrFail();
    
    $konsultasi->update([
        'penanganan' => $request->penanganan,
        'status' => 'diterima'
    ]);
    
    return redirect()->route('dokter.index')->with('success', 'Medication added and status updated to accepted.');
}
}
