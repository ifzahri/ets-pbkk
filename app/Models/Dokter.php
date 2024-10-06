<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email', 'nomor_telepon', 'keahlian'];

    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class);
    }
}
