<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email', 'nomor_telepon', 'user_id', 'alamat', 'golongan_darah', 'tanggal_lahir', 'jenis_kelamin'];

    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class);
    }
}
