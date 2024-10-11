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

        {{-- Konsultasi Form --}}
        <h2 class="mt-6 text-lg font-semibold">Create a new Konsultasi</h2>
        <form action="{{ route('konsultasi.store') }}" method="POST">
            @csrf
            <div class="mt-4">
                <label for="tanggal_keluhan" class="block text-sm font-medium text-gray-700">Date of Symptoms</label>
                <input type="date" name="tanggal_keluhan" id="tanggal_keluhan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mt-4">
                <label for="keluhan" class="block text-sm font-medium text-gray-700">Symptoms</label>
                <textarea name="keluhan" id="keluhan" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>
            <div class="mt-4">
                <label for="dokter_id" class="block text-sm font-medium text-gray-700">Pick a Doctor</label>
                <select name="dokter_id" id="dokter_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}">{{ $dokter->nama }} - {{ $dokter->keahlian }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="status" value="pending">
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Submit</button>
            </div>
        </form>

        {{-- Konsultasi History --}}
        <h2 class="mt-8 text-lg font-semibold">Your Konsultasi History</h2>
        @if($konsultasis->isEmpty())
            <p>No consultations yet.</p>
        @else
            <ul class="mt-4">
                @foreach ($konsultasis as $konsultasi)
                    <li class="border-b py-2">
                        <strong>Symptoms:</strong> {{ $konsultasi->keluhan }} <br>
                        <strong>Status:</strong> {{ $konsultasi->status }} <br>
                        <strong>Date:</strong> {{ $konsultasi->tanggal_keluhan }} <br>
                        {{-- Delete Konsultasi --}}
                        <form action="{{ route('konsultasi.destroy', $konsultasi->id) }}" method="POST" class="inline-block mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-700">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
