<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Konsultasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::where('email', Auth::user()->email)->firstOrFail();
        $konsultasis = Konsultasi::where('pasien_id', $pasien->id)->get();
        $dokters = Dokter::all();

        return view('pasien.index', compact('pasien', 'konsultasis', 'dokters'));
    }
}
