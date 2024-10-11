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
        $konsultasis = Konsultasi::where('dokter_id', $dokter->id)->get();

        return view('dokter.index', compact('dokter', 'konsultasis'));
    }
}
