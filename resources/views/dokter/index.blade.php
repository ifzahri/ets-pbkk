<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dokter Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
            <h1>Welcome, Dr. {{ $dokter->nama }}</h1>
            <p>Email: {{ $dokter->email }}</p>
            <p>Phone: {{ $dokter->nomor_telepon }}</p>
            <p>Specialization: {{ $dokter->keahlian }}</p>
        
            <h2>Your Konsultasi Requests</h2>
            @if($konsultasis->isEmpty())
                <p>No konsultasi requests yet.</p>
            @else
                <ul>
                    @foreach ($konsultasis as $konsultasi)
                        <li>
                            <strong>Keluhan:</strong> {{ $konsultasi->keluhan }} <br>
                            <strong>Status:</strong> {{ $konsultasi->status }} <br>
                            <strong>Tanggal Keluhan:</strong> {{ $konsultasi->tanggal_keluhan }} <br>
                        </li>
                    @endforeach
                </ul>
            @endif
        
    </div>
</x-app-layout>
