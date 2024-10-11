<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Pasien Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1>Welcome, {{ $pasien->nama }}</h1>
        <p>Email: {{ $pasien->email }}</p>
        <p>Phone: {{ $pasien->nomor_telepon }}</p>
        <p>Address: {{ $pasien->alamat }}</p>
        <p>Blood Type: {{ $pasien->golongan_darah }}</p>
        <p>Date of Birth: {{ $pasien->tanggal_lahir }}</p>
        <p>Gender: {{ $pasien->jenis_kelamin }}</p>
        
        <h2>Your Konsultasi History</h2>
        @if($konsultasis->isEmpty())
            <p>No consultations yet.</p>
        @else
            <ul>
                @foreach ($konsultasis as $konsultasi)
                    <li>
                        <strong>Keluhan:</strong> {{ $konsultasi->keluhan }} <br>
                        <strong>Status:</strong> {{ $konsultasi->status }} <br>
                        <strong>Date:</strong> {{ $konsultasi->tanggal_keluhan }} <br>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>

