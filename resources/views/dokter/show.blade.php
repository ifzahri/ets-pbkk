<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Penanganan') }}
        </h2>
    </x-slot>
    <h1>Details for Patient: {{ $konsultasi->pasien->name }}</h1>
    
    <p><strong>Keluhan:</strong> {{ $konsultasi->keluhan }}</p>
    <p><strong>Tanggal Keluhan:</strong> {{ $konsultasi->tanggal_keluhan }}</p>
    
    <h3>Add Medication</h3>
    <form method="POST" action="{{ route('dokter.addMedication', $konsultasi->id) }}">
        @csrf
        <textarea name="penanganan" placeholder="Add medications or treatment">{{ old('penanganan') }}</textarea>
        <button type="submit">Submit</button>
    </form>

</x-app-layout>
