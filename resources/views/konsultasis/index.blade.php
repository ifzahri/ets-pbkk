@foreach ($konsultasis as $konsultasi)
    <h3>{{ $konsultasi->dokter->nama }} - {{ $konsultasi->tanggal_keluhan }}</h3>
    <p>Status: {{ $konsultasi->status }}</p>
@endforeach
