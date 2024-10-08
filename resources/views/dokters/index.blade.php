@foreach ($dokters as $dokter)
    <h3>{{ $dokter->nama }} ({{ $dokter->keahlian }})</h3>
@endforeach
